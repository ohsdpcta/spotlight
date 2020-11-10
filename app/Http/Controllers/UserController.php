<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request){
        return view('index');
    }

    public function search(Request $request){
        $input = $request->input;
        if ($input == '') {
            $result = User::all();
        }else{
            $result = User::where('name', 'like', '%'.$input.'%')->get();
        }
        return view('search.search', ['result' => $result]);
    }

    //サインアップ//
    public function signup_form(){
        return View('user.signup_form');
    }
    //
    public function signup(Request $request){
        // バリデーションを設定する
        $request->validate([
            'name'=>'required|string|max:30',
            'social_id' => 'required|unique:users,social_id|string|max:15',
            'email'=>'required|email|max:254|unique:users,email',
            'password'=>'required|string|min:8|max:128|confirmed',
        ]);
        //$userにデータを設定する
        $user = new User;
        $user->name = $request->name;
        $user->social_id = $request->social_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //データベースに保存
        $user->save();
        //リダイレクトする
        return redirect('/');
    }
    //サインイン//
    public function signin_form(){
        //サインインビューを返す
        return view('user.signin_form');
    }

    //
    public function signin(Request $request){
        //バリデーションの設定
        $request->validate([
            'login_id'=>'string|max:256',
            'password'=>'required|string|between:8,128',
        ]);
        //サインインする
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


}
