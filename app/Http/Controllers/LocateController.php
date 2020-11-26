<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(!empty($locate_data->coordinate)){
            $locate_array = explode(',', $locate_data->coordinate);
        }else{
            $locate_array = [];
        }
        return view('summary.edit_locate', compact('locate_array'));
    }

    //ロケーション+住所登録
    public function update(Request $request, $id){
        $request->validate([
            'coordinate' => 'required|string'
        ]);
        if(Auth::id() == $id){
            $locate = Locate::where('user_id', Auth::id())->first();
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
        if(Locate::where('user_id', Auth::id())->delete()){
            session()->flash('flash_message', 'ロケーションを削除しました');
        }
        return redirect("/user/{$id}/summary/locate");
    }
}
