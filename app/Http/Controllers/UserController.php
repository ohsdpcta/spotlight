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
use Session;
use Illuminate\Session\SessionManager;
use App\Mail\HelloEmail;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Validator;
use Mail;
//aws s3アップロード
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;



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
        return view('search_result', ['result' => $result]);
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


        // ログイン
        Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        $login_user_id = Auth::id();
        // Profileを作成
        $profile = new Profile;
        $profile->user_id = $login_user_id;
        $profile->content = 'よろしくお願いします！';
        $profile->save();
        Mail::to($request->email)->send(new HelloEmail($data));
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
        //画像アップロードhttps://noumenon-th.net/programming/2020/02/26/laravel-aws-s3/
        $image = $request->file('image');
        $path = Storage::disk('s3')->put('tmp/', $image, 'public');

        // dataに値を設定
        $data = User::find($id);
        $data->name = $request->name;
        $data->role = $request->role;
        $data->path = Storage::disk('s3')->url($path);
        if($data->save()){
            session()->flash('flash_message', 'アカウント情報の編集が完了しました');
        }
        return redirect("user/{$id}/summary/account");
    }

    // アカウント削除
    public function delete(Request $request, $id) {
        $data = User::find($id);
        return view('summary.delete_account', compact('data'));
    }

    public function remove(Request $request, $id) {
        // レコードを削除する。
        User::find($id)->delete();
        return redirect("/");
    }

    // 投げ銭
    public function tip(Request $request, $id){
        $url = UserClass::get_paypay_url($id);
        return view('social.paypay', compact('url'));
    }
    //mail本文
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
    //パスワード変更メール送信ページ
    public function change(Request $request){
        return view('emails.change');
    }
    //送信
    public function send(Request $request){

    }




}
