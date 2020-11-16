<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Follower;
use App\Map;

class LocateController extends Controller
{
    // gmap表示
    public function view(Request $request, $id) {
        // 3d34.7029743!4d135.4881499
        // 3d55.378051!4d-3.435973
        // 3d34.661249!4d135.4774788
        $gmap_url = "https://www.google.co.jp/maps/place/%E6%9D%B1%E4%BA%AC%E3%83%93%E3%83%83%E3%82%B0%E3%82%B5%E3%82%A4%E3%83%88/@35.6298179,139.7920981,17z/data=!3m1!4b1!4m5!3m4!1s0x601889dc629d1e7b:0xa4d1509a76045a01!8m2!3d35.6298179!4d139.7942868";
        preg_match('/3d\d{1,3}\.\d{6,7}!4d-?\d{1,3}\.\d{6,7}/', $gmap_url, $ping_locate_info);
        $delete_words = ['3d', '4d'];
        $ping_locates = str_replace($delete_words, '', $ping_locate_info[0]);
        $locate_array = explode('!', $ping_locates);
        return view('locate.map', compact('locate_array'));
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
