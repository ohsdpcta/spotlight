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
    public function view_locate(Request $request, $id) {
        $gmap_url = Locate::where('user_id', $id)
            ->select('coordinate')
            ->first();
        preg_match('/3d\d{1,3}\.\d{6,7}!4d-?\d{1,3}\.\d{6,7}/', $gmap_url, $ping_locate_info);
        $delete_words = ['3d', '4d'];
        $ping_locates = str_replace($delete_words, '', $ping_locate_info[0]);
        $locate_array = explode('!', $ping_locates);
        return view('locate.view_locate', compact('locate_array'));
    }

    //ロケーション+住所登録フォーム
    public function add_locate_form(Request $request){
        return view('locate.add_locate');
    }

    //ロケーション+住所登録
    public function add_locate(Request $request, $id){
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
        return redirect("/user/{$id}/profile");

    }
    //ロケーション住所削除
    public function del_locate_form(Request $request,$id){
        $data = Locate::where('user_id', Auth::id())->get();
        return view('locate.del_locate', compact('data'));
    }
    public function remove_locate(Request $request,$id){
        // レコードを削除する。
        $return = Locate::find($id);
        Locate::where('user_id', Auth::id())->delete();
        return redirect("/user/{$id}/profile");
    }
}
