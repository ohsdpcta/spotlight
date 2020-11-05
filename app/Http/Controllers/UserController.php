<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //サインアップ
    public function Signup_form(){
        return View('user.signup');
    }

    public function Signup(Request $request){
        //$userにデータを設定する
        $user = new User;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //データベースに保存
        $user->save();
        //リダイレクトする
        return redirect('/');
    }


}
