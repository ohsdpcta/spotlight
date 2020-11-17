<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Sample;
use App\Goods;
use App\Map;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function edit(Request $request)
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
        return view('edit.goods_edit', compact('data'));
    }

    public function add(Request $request)
    {
        return view('edit.add');
    }

    public function create(Request $request, $id)
    {
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $addgoods->name = $request->name;
        $addgoods->url = $request->url;
        $addgoods->save();
        return redirect("user/{$id}/edit/goods");
    }

    public function del(Request $request, $id, $goods_id) {
        $data = Goods::find($goods_id);
        return view('edit.del', compact('data'));
    }

    public function remove(Request $request, $id, $goods_id) {
        // レコードを削除する。
        Goods::find($goods_id)->delete();
        return redirect("user/{$id}/edit/goods");
    }
    //複数選択削除
    public function multi_del(Request $request, $id ) {

        $data = Goods::find($id);
        return view('goods.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        return redirect("/user/{$id}/goods");
    }
    public function sample_edit(Request $request, $id)
    {
        $data = Sample::where('user_id', $id)->get();
        return view('edit.sample_edit', compact('data'));
    }
    public function sample_add(Request $request) {
        return view('edit.sample_add');
    }
    public function sample_create(Request $request, $id) {
        // レコードを追加する。
        $addsample = new Sample;
        $addsample->user_id = $id;
        $addsample->name = $request->name;
        $addsample->url = $request->url;
        $addsample->save();
        return redirect("user/{$id}/edit/sample");
    }

    public function sample_del(Request $request, $id) {
        $data = Sample::where('id', $id)->get();
        return view('edit.sample_del', compact('data'));
    }

    public function sample_remove(Request $request, $id) {
        // レコードを削除する。
        $return = Sample::find($id);
        Sample::where('id', $id)->delete();
        return redirect("/user/{$return->user_id}/sample");
    }
}

