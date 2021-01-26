<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Locate;

class LocateController extends Controller
{
    // gmap表示
    public function index(Request $request, $id) {
        $locate_data = Locate::where('user_id', $id)->first();
        if(!empty($locate_data->coordinate)){
            $locate_array = explode(',', $locate_data->coordinate);
        }else{
            $locate_array = [];
        }
        return view('index.locate', compact('locate_array'));
    }

    //ロケーション+住所登録フォーム
    public function edit(Request $request, $id){
        $locate_data = Locate::where('user_id', $id)->first();
        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);
        if(!empty($locate_data->coordinate)){
            $locate_array = explode(',', $locate_data->coordinate);
        }else{
            $locate_array = [];
        }
        return view('summary.edit_locate', compact('locate_array', 'locate_data'));
    }

    //ロケーション+住所登録
    public function update(Request $request, $id){
        // バリデーションの設定
        $rules = [
            'prefecture_city'=>'required',
            'coordinate'=>'required|regex:/^[-\d]\d{0,2}.\d{5,30},[-\d]\d{0,3}.\d{5,30}$/',
        ];
        $messages = [
            'prefecture_city.required' => '活動地域を入力してください。',
            'coordinate.required' => '登録したい場所をクリックしてください。',
            'coordinate.regex' => '入力欄に座標が入っていることを確認してから、もう一度登録してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/locate")
                ->withErrors($validator)
                ->withInput();
        }
        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);

        $locate = Locate::where('user_id', Auth::id())->first();
        if(Auth::id() == $id){
            if(!$locate){
                $locate = new Locate;
                $locate->user_id = Auth::id();
            }
        }
        preg_match( '/北海道|県|府|都/', $request->prefecture_city, $matches );
        if ($matches[0] == "北海道") {
            preg_match('/(北海道)(\S+市)/', $request->prefecture_city, $matches );
            $locate->prefecture = $matches[1];
            $locate->city = $matches[2];
        } elseif($matches[0] == '県') {
            preg_match('/(\S+県)(\S+市)/', $request->prefecture_city, $matches );
            $locate->prefecture = $matches[1];
            $locate->city = $matches[2];
        } elseif($matches[0] == '府') {
            preg_match('/(\S+府)(\S+市)/', $request->prefecture_city, $matches );
            $locate->prefecture = $matches[1];
            $locate->city = $matches[2];
        } elseif($matches[0] == '都') {
            preg_match('/(\S+都)(\S+[市区])/', $request->prefecture_city, $matches );
            $locate->prefecture = $matches[1];
            $locate->city = $matches[2];
        } else {
            session()->flash('flash_message', '入力内容を確認してもう一度入力してください。');
            return redirect("user/{$id}/summary/sample/add");
        }

        if(Auth::id() == $id){
            if($locate){
                $locate->coordinate = $request->coordinate;
            }else{
                $locate = new Locate;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $locate->user_id = Auth::id();
                $locate->coordinate = $request->coordinate;
            }
            if($locate->save()){
                session()->flash('flash_message', 'ロケーションの設定が完了しました');
            }
        }
        return redirect("/user/{$id}/summary/locate");
    }

    public function remove(Request $request,$id){
        // レコードを削除する。
        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);
        if(Locate::where('user_id', Auth::id())->delete()){
            session()->flash('flash_message', 'ロケーションを削除しました');
        }
        return redirect("/user/{$id}/summary/locate");
    }
}