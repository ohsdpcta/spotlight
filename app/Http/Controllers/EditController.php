<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Goods;
use App\Map;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        return view('edit.edit');
    }
    public function user_edit(Request $request)
    {
        return view('edit.user');
    }
    public function map(Request $request, $id) {

        $data = tekitou::find($id);
        $locate = tekitou::where('taeget_id' ,$id);

        return view('locate.map', compact('data', 'follow_flg', 'follower'));
    }
    //ロケーション+住所登録フォーム
    public function add_address_form(Request $request){
        return view('edit.locate_edit');

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
        return redirect("/user/{$id}/edit/locate");

    }
    //ロケーション住所削除
    public function del_address_form(Request $request,$id){
        $data = Map::where('user_id', Auth::id())->get();
        return view('edit.locate_edit', compact('data'));
    }
    public function remove_address(Request $request,$id){
        // レコードを削除する。
        $return = Map::find($id);
        Map::where('user_id', Auth::id())->delete();
        return redirect("/user/{$id}/edit/locate");
    }

    public function goods(Request $request, $id)
    {
        $data = Goods::where('user_id', $id)->get();
        return view('goods.goods', compact('data'));
    }
    
    public function add(Request $request)
    {
        return view('goods.add');
    }

    public function create(Request $request, $id)
    {
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $addgoods->name = $request->name;
        $addgoods->url = $request->url;
        $addgoods->save();
        return redirect("user/{$id}/goods");
    }
    public function del(Request $request, $id) {
        $data = Goods::where('id', $id)->get();
        return view('Goods.del', compact('data'));
    }

    public function remove(Request $request, $id) {
        // レコードを削除する。
        $return = Goods::find($id);
        Goods::where('id', $id)->delete();
        return redirect("/user/{$return->user_id}/goods");
    }
    public function sample_edit(Request $request)
    {
        return view('edit.sample_edit');
    }
}
