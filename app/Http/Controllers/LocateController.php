<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Follower;
use App\Map;

class LocateController extends Controller
{
    public function map(Request $request, $id) {

        $data = tekitou::find($id);
        $locate = tekitou::where('taeget_id' ,$id);

        return view('locate.map', compact('data', 'follow_flg', 'follower'));
    }
    //ロケーション+住所登録フォーム
    public function add_address_form(Request $request){
        return view('locate.add_address');

    }
    //ロケーション+住所登録
    public function add_address(Request $request, $id){
        $request->validate([
            'street_address' => 'required|max:255|string'
        ]);
        if(Auth::id() == $id){
            $map_address = Map::where('user_id', Auth::id())->first();
            if($map_address){
                $map_address->street_address = $request->street_address;
                $map_address->save();
            }else{
                $map_address = new Map;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $map_address -> user_id = Auth::id();
                $map_address -> street_address = $request->street_address;
                $map_address -> save();
            }
        }
        return redirect("/user/{$id}/profile");

    }
    //ロケーション住所削除
    public function del_address_form(Request $request,$id){
        $data = Map::where('user_id', Auth::id())->get();
        return view('locate.del_address', compact('data'));
    }
    public function remove_address(Request $request,$id){
        // レコードを削除する。
        $return = Map::find($id);
        Map::where('user_id', Auth::id())->delete();
        return redirect("/user/{$id}/profile");
    }
}
