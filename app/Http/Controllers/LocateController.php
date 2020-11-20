<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Follower;
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

    public function edit_locate(Request $request, $id) {
        $gmap_url = Locate::where('user_id', $id)
            ->select('coordinate')
            ->first();
        if(!empty($gmap_url)){
            preg_match('/3d\d{1,3}\.\d{6,7}!4d-?\d{1,3}\.\d{6,7}/', $gmap_url, $ping_locate_info);
            $delete_words = ['3d', '4d'];
            $ping_locates = str_replace($delete_words, '', $ping_locate_info[0]);
            $locate_array = explode('!', $ping_locates);
        }else{
            $locate_array = [];
        }
        return view('summary.edit_locate', compact('locate_array'));
    }

    //ロケーション+住所登録フォーム
    public function edit(Request $request, $id){
        $gmap_url = Locate::where('user_id', $id)
            ->select('coordinate')
            ->first();
        if(!empty($gmap_url)){
            preg_match('/3d\d{1,3}\.\d{6,7}!4d-?\d{1,3}\.\d{6,7}/', $gmap_url, $ping_locate_info);
            $delete_words = ['3d', '4d'];
            $ping_locates = str_replace($delete_words, '', $ping_locate_info[0]);
            $locate_array = explode('!', $ping_locates);
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
                $locate->save();
            }else{
                $locate = new Locate;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $locate->user_id = Auth::id();
                $locate->coordinate = $request->coordinate;
                $locate->save();
            }
        }
        return redirect("/user/{$id}/summary/locate");

    }
    public function remove(Request $request,$id){
        // レコードを削除する。
        Locate::where('user_id', Auth::id())->delete();
        return redirect("/user/{$id}/summary/locate");
    }
}
