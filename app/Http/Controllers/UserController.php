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
// use Mail;

//aws s3アップロード
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;


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
        // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
        return redirect()->intended("user/{$login_user_id}/profile")->with('flash_message', 'メールアドレスに本登録メールを送信しました');
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
        //バリデーションの設定
        $rules = [
            'name'=>'required|string|max:30',
            'image'=>'image',
        ];
        $messages = [
            'name.required' => 'ユーザー名を入力してください。',
            'name.max' => '３０文字以内で入力してください。',
            'name.string' => '入力方法が違います。',
            'image.image' => '画像を選択してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/account")
                ->withErrors($validator)
                ->withInput();
        }

        //画像アップロード
        if(request('image')){
            $random = Str::random(32);
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile("tmp/{$random}", $image, 'public');
        }
        // dataに値を設定
        $data = User::find($id);
        $data->name = $request->name;
        $data->role = $request->role;
        if(request('image'))$data->avatar = Storage::disk('s3')->url($path);//dataに値を設定
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
    public function changeupdate(Request $request, $id){
        //バリデーションの設定
        $request->validate([
            'old_password'=>'required|string|between:8,128',
            'new_password'=>'required|string|between:8,128',
            'new_password_check'=>'required|string|between:8,128',
        ]);
        $user = Profile::where('user_id', $id)->first();
        $this->authorize('social', $user);

        $data = Auth::user();
        $id = Auth::id();
        $pass_data = User::where('password',$request['old_password'])->first();
        //現在のパスワードがデータベースにあることを確認するようにする

        if($request['old_password']!=$request['new_password']){//現在のパスワードと新しいパスワードが同じではない
            if($request['old_password'] === $pass_data){
                $data->password = bcrypt($request['new_password']);
                $data->save();
            }else{
                return back()->withInput()->with('flash_message_error', '現在のパスワードが間違っています');
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
    public function socialupdate(Request $request, $id){
        //バリデーションの設定
        $request->validate([
            'new_social'=>'required|unique:users,social_id|string|max:30|confirmed',
            'new_social_confirmation'=>'required|string|max:30',
        ]);
        $user = User::find($id);
        $user->social_id = $request->new_social;
        $user->save();
        return redirect("/user/{$id}/summary/account/")->with('flash_message', 'ソーシャルIDの変更完了しました');
    }

    //メールアドレス変更機能
    //ここで変更
    public function mailupdate(Request $request, $id){
        //バリデーションの設定
        $request->validate([
            'new_mail'=>'required|email|max:254|confirmed',
            'new_mail_confirmation'=>'required|email|max:254',
        ]);

        $user = Profile::where('user_id', $id)->first();
        $this->authorize('social', $user);

        if(User::where('email', $request->new_mail)->first()){
            return redirect("/user/{$id}/summary/account/")->with('flash_message_error', '入力されたメールアドレスは使用されています');
        }
        $older_new_mail_data = Newemail::where('email', $request->new_mail)->first();
        if($older_new_mail_data){
            $older_new_mail_data->delete();
        }
        $new_mail_data = new Newemail;
        $new_mail_data->user_id = Auth::id();
        $new_mail_data->email = $request->new_mail;
        $new_mail_data->email_verify_token = base64_encode($request->new_mail);
        $new_mail_data->save();

        Mail::to($request->new_mail)->send(new MailChangeCheck($new_mail_data->email_verify_token));
        return redirect("/user/{$id}/summary/account/")->with('flash_message', 'メール送信完了しました');
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
