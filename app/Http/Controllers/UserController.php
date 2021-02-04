<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Library\UserClass;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
//メール
use App\Mail\HelloEmail;
use App\Mail\passChangeMaill;
use  App\Mail\SocalIDChange;
use App\Mail\MailChange;
use App\Mail\MailChangeCheck;
use App\Mail\ResetMail;
use App\Newemail;
use Illuminate\Support\Facades\Mail;


use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Validator;
//use Mail;



use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // インデックス
    public function index(Request $request){

        return view('index');
    }

    // 検索結果
    public function search(Request $request){
        $input = $request->search;
        if ($input == '') {
            $result = User::paginate(10);
        }else{
            $result = User::where('name', 'like', '%'.$input.'%')->paginate(10);
        }
        return view('search_result', ['users' => $result]);
    }

    //サインアップフォーム
    public function signup_form(){
        return View('user.signup');
    }

    // サインアップ
    public function signup(Request $request){
        // バリデーションを設定する
        $rules = [
            'name'=>'required|string|max:30',
            'social_id' => 'required|unique:users,social_id|string|max:30',
            'email'=>'required|email|max:254|unique:users,email',
            'password'=>'required|string|min:8|max:128|confirmed',
        ];
        $messages = [
            'name.required' => '名前を入力して下さい。',
            'name.max' => '名前は30文字以下で入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.email' => '正しいメールアドレスを入力して下さい。',
            'password.required' => 'パスワードを入力して下さい。',
            'password.max' => 'パスワードは128文字以下で入力して下さい。',
        ];


        //メール送信
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/user/signup')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validate();



        // $userにデータを設定する
        $user = new User;
        $user->name = $request->name;
        $user->social_id = $request->social_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verify_token = base64_encode($request->email);
        $user->save();
        $user_token = $user->email_verify_token;

        // ログイン
        Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        $login_user_id = Auth::id();
        // Profileを作成
        $profile = new Profile;
        $profile->user_id = $login_user_id;
        $profile->content = 'よろしくお願いします！';
        $profile->save();
        Mail::to($request->email)->send(new HelloEmail($user_token));
        /*
        // $fakeに仮データを設定
        $fake = new Newemail;
        $fake->user_id = $login_user_id;
        $fake->email = $request->email;
        $fake->email_verify_token = base64_encode($request->email);
        $fake->save();
        */
        // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
        return redirect()->intended("user/{$login_user_id}/profile");
    }

    //サインインフォーム
    public function signin_form(){
        return view('user.signin');
    }

    // サインイン
    public function signin(Request $request){
        //バリデーションの設定
        $request->validate([
            'login_id'=>'string|max:256',
            'password'=>'required|string|between:8,128',
        ]);
        $login_id = $request->login_id;
        if (filter_var($login_id, \FILTER_VALIDATE_EMAIL)) {
            if(Auth::attempt(['email'=> $login_id,'password' => $request->input('password')],$request->remember)):
                // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
                session()->flash('flash_message','ログインしました。');
                $id = Auth::id();
                return redirect()->intended("user/$id/profile");
            endif;
        } else {
            if(Auth::attempt(['social_id'=> $login_id,'password' => $request->input('password')],$request->remember)):
                // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
                session()->flash('flash_message','ログインしました。');
                $id = Auth::id();
                return redirect()->intended("user/$id/profile");
            endif;
        }
        //失敗した場合はsigninにリダイレクト
        $auth_error = 'ログイン情報が間違っています。';
        return view('user.signin',['auth_error'=>$auth_error]);
    }

    // サインアウト
    public function signout(Request $request){
        Auth::logout();
        return redirect('/');
    }


    // Twitterログイン
    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }
    // Twitterログインコールバック
    public function handleProviderCallback(){
        try{
            $user = Socialite::driver('twitter')->user();
            $socialUser = User::firstOrCreate([
                'token' => $user->token,
            ], [
                'social_id' => $user->nickname,
                'token' => $user->token,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar_original,
                'status' => '2',
            ]);
            if(empty($socialUser->email_verified_at)){
                $socialUser->email_verified_at = now();
                $socialUser->save();
            }
            Auth::login($socialUser, true);
            $login_user_id = Auth::id();
            $old_profile = Profile::where('user_id', $login_user_id)->first();
            if(!$old_profile){
                // Profileを作成
                $profile = new Profile;
                $profile->user_id = $login_user_id;
                $profile->content = 'よろしくお願いします！';
                $profile->save();
            }
        }catch (Exception $e){
            return redirect('/user/signin');
        }
        return redirect("/user/{$login_user_id}/profile");
    }

    // Googleログイン
    public function redirectToProviderGoogle(){
        return Socialite::driver('google')->redirect();
    }
    // Googleログインコールバック
    public function handleProviderCallbackGoogle(){
        try{
            $user = Socialite::driver('google')->user();
            $socialUser = User::firstOrCreate([
                'email' => $user->email,
            ], [
                'social_id' => $user->id,
                'token' => $user->token,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar_original,
                'status' => '2',
            ]);
            if(empty($socialUser->email_verified_at)){
                $socialUser->email_verified_at = now();
                $socialUser->save();
            }
            Auth::login($socialUser, true);
            $login_user_id = Auth::id();
            $old_profile = Profile::where('user_id', $login_user_id)->first();
            if(!$old_profile){
                // Profileを作成
                $profile = new Profile;
                $profile->user_id = $login_user_id;
                $profile->content = 'よろしくお願いします！';
                $profile->save();
            }
        }catch (Exception $e){
            return redirect('/user/signin');
        }
        return redirect("/user/{$login_user_id}/profile");
    }

    // アカウント情報編集フォーム
    public function edit(Request $request, $id) {
        $data = User::where('id', $id)->first();
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $user);
        return view('summary.edit_account', compact('data'));
    }

    // アカウント情報編集
    public function update(Request $request, $id) {
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $user);
        // //バリデーションの設定
        $rules = [
            'name'=>'required|string|max:30',
        ];
        $messages = [
            'name.required' => 'ユーザー名を入力してください。',
            'name.max' => '３０文字以内で入力してください。',
            'name.string' => '入力方法が違います。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/account")
                ->withErrors($validator)
                ->withInput();
        }
        // dataに値を設定
        $data = User::find($id);
        $data->name = $request->name;
        $data->role = $request->role;
        if($data->save()){
            session()->flash('flash_message', 'アカウント情報の編集が完了しました');
        }

        return redirect("user/{$id}/summary/account");
    }
    // アカウント削除
    public function delete(Request $request, $id) {
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $user);
        $data = User::find($id);
        return view('summary.delete_account', compact('data'));
    }

    public function remove(Request $request, $id) {
        // レコードを削除する。
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $user);
        User::find($id)->delete();
        return redirect("/");
    }

    // 投げ銭
    public function tip(Request $request, $id){
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $user);
        $url = UserClass::get_paypay_url($id);
        return view('social.paypay', compact('url'));
    }
    //mail認証
    public function conteact(Request $request){
        $users = Auth::user();
        return view('emails.contact',compact('users'));
    }
    // メール
    public function authentication(Request $request, $token){
        $users = Auth::user();
        if ($users->email_verify_token === $token){
            return view('emails.authentication',compact('users'));
        }else{
            return redirect('/');
        }

    }
    //トークン付与
    public function confirmation(Request $request){
        $users = Auth::user();
         // 使用可能なトークンか
        if ( !User::where('email_verify_token',$users->email_verify_token)->exists() )
        {

            return view('auth.main.register')->with('message', '無効なトークンです。');
        } else {
            $user_data = User::where('email_verify_token', $users->email_verify_token)->first();
             // ユーザーステータス更新
            if (User::where('email_verify_token',$users->email_verify_token)->exists() ){
                //$user_data->email_verified_at = Carbon::now();
                $user_data->status = '2';
                $user_data->save();

                return view('auth.main.registered');
            }else{
                return view('auth.main.register')->with('message', 'トークンが一致しませんでした。');
            }

        }
    }

    //passここで変更
    public function changeupdate(Request $request){
        //バリデーションの設定
        $request->validate([
            'old_password'=>'required|string|between:8,128',
            'new_password'=>'required|string|between:8,128',
            'new_password_check'=>'required|string|between:8,128',
        ]);
            $data = Auth::user();
            $id = Auth::id();
            $pass_data = User::where('password',$request['old_password'])->first();
            //現在のパスワードがデータベースにあることを確認するようにする

        if($request['old_password']!=$request['new_password']){//現在のパスワードと新しいパスワードが同じではない
            if($request['old_password'] === $pass_data){
                $data->password = bcrypt($request['new_password']);
                $data->save();
            }else{
                return back()->withInput()->with('flash_message', '現在のパスワードが間違っています');
            }
        }else{
            return back()->withInput()->with('flash_message', '現在のパスワードと新しいパスワードが同じです');
        }
        if($request['new_password_check'] === $request['new_password']){
                return redirect("/user/{$id}/summary/account/")->with('flash_message', 'パスワードの変更を完了しました');
        }else{
            return back()->withInput()->with('flash_message', '確認パスワードと新しいパスワードが一致しません');
        }
    }

    //ソーシャルここで変更
    public function socialupdate(Request $request){
        //バリデーションの設定
        $request->validate([
            'old_social'=>'required|string|max:30',
            'new_social'=>'required|unique:users,social_id|string|max:30',
            'new_social_check'=>'required|string|max:30',
        ]);
            $data = Auth::user();
            $id = Auth::id();
        if($request['old_social'] == $data->social_id){
            if($request['old_social']!=$request['new_social']){
                $data->social_id = $request['new_social'];
                $data->save();
            }else{
                return back()->withInput()->with('flash_message', '古いソーシャルIDとソーシャルIDが同じです');
            }
        }else{
            return back()->withInput()->with('flash_message', '古いソーシャルIDが間違っています');
        }

        if($request['new_social_check'] === $request['new_social']){
                return redirect("/user/{$id}/summary/account/")->with('flash_message', 'ソーシャルIDの変更完了しました');
        }else{
            return back()->withInput()->with('flash_message', '確認ソーシャルIDと新しいソーシャルIDが一致しません');
        }
    }

    //メールアドレス変更機能
    //ここで変更
    public function mailupdate(Request $request,$id){
        //バリデーションの設定
        $request->validate([
            'old_mail'=>'required|email|max:254',
            'new_mail'=>'required|email|max:254',
            'new_mail_check'=>'required|email|max:254',
        ]);
        $data = Auth::user();
        $user_data = User::select('email')->get();
        $old_new_email = NewEmail::where('email','$request->new_email')->first();//NEWEMAILテーブルの新しいEmailと同じデータを持ってくる
        $id = Auth::id();//IDデータ
        foreach($user_data as $value){

            if($request['new_email'] === $value->email){//newemailがユーザーテーブルのemailに既に登録されていない

                return redirect("/user/{$id}/summary/account/")->with('flash_message', 'すでにそのメールアドレスは使用されています');
            }
        }
            $new_email = new NewEmail;//NEWEMAILテーブルにデータの保存
            $new_email->user_id = $data->id;
            $new_email->email = $request['new_mail'];
            $new_email->email_verify_token = base64_encode($request['new_mail']);
        if($request['new_email'] != $old_new_email){//newemailがnewemailテーブルに登録されていないか

            $new_email->save();//NEWEMAILテーブルにデータの保存
            $email_data = $new_email->email_verify_token;//メールに送るデータ
            Mail::to($request['new_mail'])->send(new MailChangeCheck($email_data));
            return redirect("/user/{$id}/summary/account/")->with('flash_message', 'メール送信完了しました');
        }else{

            if($data->id === $new_email->user_id){//登録したのがログインユーザーかどうか

                Newemail::where('user_id', $data->id)->delete();//Newemailから新メールアドレスの削除
                $new_email->save();//NEWEMAILテーブルにデータの保存
                $email_data = $new_email->email_verify_token;//メールに送るデータ
                Mail::to($request['new_mail'])->send(new MailChangeCheck($email_data));
                //ここにリダイレクト必須
                return redirect("/user/{$id}/summary/account/")->with('flash_message', 'メール送信完了しました');
            }else{

                return redirect("/user/{$id}/summary/account/")->with('flash_message', 'ほかのユーザーのメールアドレスは保存できません');
            }
        }
    }

    //メール
    public function donemail(Request $request, $id, $token){
        return view('emails.done', compact('id', 'token'));
    }

    //変更確定処理
    public function done(Request $request, $id, $token){
        $new_email_data = Newemail::where('email_verify_token', $token)->first();
        $user = $new_email_data->user;
        if(Auth::user()){
            if(Auth::id() == $user->id){
                $user->email = $new_email_data->email;
                $user->save();
            }else{
                return redirect("/user/{Auth::user()->id}/profile")->with('flash_message', 'ログインユーザーが異なります');
            }
        }else{
            return redirect("/user/signin")->with('flash_message', 'ログインしてから再度実行してください');
        }

        $new_email_data->delete();  //Newemailから新メールアドレスの削除
        return redirect("/user/{$id}/summary/account/")->with('flash_message', 'メールアドレスの変更を完了しました');
    }

        //パスワードリセット
    public function resetform(Request $request){
            return view('emails.resetform');
        }
        //パスワードリセットメール送信
        public function resetmail(Request $request){
            //バリデーションの設定
            $request->validate([
                'email'=>'required|email|max:254',
            ]);
            $users = User::get();
                foreach($users as $value){
                    if($request['email'] === $value->email ){
                        $data = $value->email;
                        $data_token = base64_encode($data);
                        Mail::to($request['email'])->send(new ResetMail($data,$data_token));
                        return redirect("/user/signin")->with('flash_message', 'パスワードリセットメールの送信が完了しました');
                    }
                }
                return redirect("/user/signin")->with('flash_message', '登録されていないメールアドレスです');
        }
        //パスワードリセットフォーム
        public function passform(Request $request,$token){
            $email_token = $token;

            return view('emails.passform',compact('email_token'));
        }
        //パスワードリセット
        public function resetpass(Request $request){
            //バリデーションの設定
            $request->validate([
                'new_password'=>'required|string|between:8,128',
                'new_password_check'=>'required|string|between:8,128',
            ]);
            $token = $request->email_token;
            $users = User::where('email_verify_token',$token )->first();

            if($users->email_verify_token === $token ){
                $dbdata = User::where('email_verify_token',$token )->first();
                if($request['new_password'] === $request['new_password_check'] ){
                    $dbdata->password = bcrypt($request['new_password']);
                    $dbdata->save();
                }else{
                    return back()->withInput()->with('flash_message', '確認パスワードと新規パスワードが一致しません。');
                }
            }else{
                return redirect("/user/signin")->with('flash_message', '不正なアクセスです。');
            }
            return redirect("/user/signin")->with('flash_message', 'パスワード変更が完了しました。');


        }

}
