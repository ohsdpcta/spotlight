<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypay;
use App\Library\UserClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaypayController extends Controller
{
    public function edit(Request $request, $id){
        $url = UserClass::get_paypay_url($id);
        return view('summary.edit_paypay', compact('url'));
    }

    public function update(Request $request, $id){
        // //バリデーションの設定
        $rules = [
            'url'=>'required|between:1,190|url',
        ];
        $messages = [
            'url.required' => 'URLを入力してください',
            'url.between' => '１９０文字以内で入力してください。',
            'url.url' => 'URLを正しく入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect("user/{$id}/summary/paypay")
                    ->withErrors($validator)
                    ->withInput();
        }
        $paypay = $validator->validate();
        if(Auth::id() == $id){
            $paypay = Paypay::where('user_id', Auth::id())->first();
            if($paypay){
                $paypay->url = $request->url;
            }else{
                $paypay = new Paypay;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $paypay->user_id = Auth::id();
                $paypay->url = $request->url;
            }
            if($paypay->save()){
                session()->flash('flash_message', 'URLの設定が完了しました');
            }
        }
        return redirect("/user/{$id}/summary/paypay");
    }

    public function remove(Request $request, $id){
        // レコードを削除する。
        if(Paypay::where('user_id', Auth::id())->delete()){
            session()->flash('flash_message', 'URLを削除しました');
        }
        return redirect("/user/{$id}/summary/paypay");
    }

}
