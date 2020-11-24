<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypay;
use App\Library\UserClass;
use Illuminate\Support\Facades\Auth;

class PaypayController extends Controller
{
    public function edit(Request $request, $id){
        $url = UserClass::get_paypay_url($id);
        return view('summary.edit_paypay', compact('url'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'url' => 'required|string'
        ]);
        if(Auth::id() == $id){
            $paypay = Paypay::where('user_id', Auth::id())->first();
            if($paypay){
                $paypay->url = $request->url;
                $paypay->save();
            }else{
                $paypay = new Paypay;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $paypay->user_id = Auth::id();
                $paypay->url = $request->url;
                $paypay->save();
            }
        }
        return redirect("/user/{$id}/summary/paypay");
    }

    public function remove(Request $request, $id){
        // レコードを削除する。
        Paypay::where('user_id', Auth::id())->delete();
        return redirect("/user/{$id}/summary/paypay");
    }

}
