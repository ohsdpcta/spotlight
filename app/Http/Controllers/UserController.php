<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Library\UserClass;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'name'=>'required|string|max:30',
            'social_id' => 'required|unique:users,social_id|string|max:30',
            'email'=>'required|email|max:254|unique:users,email',
            'password'=>'required|string|min:8|max:128|confirmed',
        ]);
        // $userにデータを設定する
        $user = new User;
        $user->name = $request->name;
        $user->social_id = $request->social_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // ログイン
        Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        $login_user_id = Auth::id();
        // Profileを作成
        $profile = new Profile;
        $profile->user_id = $login_user_id;
        $profile->content = 'よろしくお願いします！';
        $profile->save();
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
            ]);
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

    public function edit(Request $request, $id) {
        $data = User::where('id', $id)->first();
        return view('summary.edit_account', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = User::where('id', $id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        return redirect("user/{$id}/summary/account");
    }


    // 投げ銭
    public function tip(Request $request, $id){
        $url = UserClass::get_paypay_url($id);
        return view('social.paypay', compact('url'));
    }

}