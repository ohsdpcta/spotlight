<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //サインアップ
    public function signup_form(){
        return View('user.signup_form');
    }

    public function signup(Request $request){
        // バリデーションを設定する
        $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|email|max:254|unique:users,email',
            'password'=>'required|string|min:8|max:128|confirmed',
        ]);
        //$userにデータを設定する
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //データベースに保存
        $user->save();
        //リダイレクトする
        return redirect('/');
    }


}
