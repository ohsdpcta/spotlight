<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // インデックス
    public function index(Request $request){
        return view('index');
    }

    // 検索結果
    public function search(Request $request){
        $input = $request->input;
        if ($input == '') {
            $result = User::all();
        }else{
            $result = User::where('name', 'like', '%'.$input.'%')->get();
        }
        return view('search.search', ['result' => $result]);
    }

    //サインアップフォーム
    public function signup_form(){
        return View('user.signup_form');
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
        return view('user.signin_form');
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
                return redirect()->intended('/');
            endif;
        } else {
            if(Auth::attempt(['social_id'=> $login_id,'password' => $request->input('password')],$request->remember)):
                // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
                session()->flash('flash_message','ログインしました。');
                return redirect()->intended('/');
            endif;
        }
        //失敗した場合はsigninにリダイレクト
        $auth_error = 'ログイン情報が間違っています。';
        return view('user.signin_form',['auth_error'=>$auth_error]);
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
                'token' => $user->token,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar_original,
            ]);
            Auth::login($socialUser, true);
            // Profileを作成
            $login_user_id = Auth::id();
            $profile = new Profile;
            $profile->user_id = $login_user_id;
            $profile->content = 'よろしくお願いします！';
            $profile->save();
        }catch (Exception $e){
            return redirect('/user/signin');
        }
        return redirect("/user/{$login_user_id}/profile");
    }
}