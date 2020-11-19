<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    // 一覧
    public function goods(Request $request, $id){
        $data = Goods::where('user_id', $id)->get();
        return view('goods.goods', compact('data'));
    }
    //新規追加
    public function add(Request $request){
        return view('goods.add');
    }

    public function create(Request $request, $id){
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $addgoods->name = $request->name;
        $addgoods->url = $request->url;
        $addgoods->save();
        return redirect("user/{$id}/goods");
    }
    //編集
    public function edit(Request $request,$id,$goods_id){
        $data = Goods::find($goods_id);
        return view('goods.edit',compact('data'));
    }
    public function update(Request $request,$id,$goods_id){
        if(Auth::id() == $id){
            $addgoods = Goods::where('user_id', Auth::id())->first();
            if($addgoods){
                $addgoods->name = $request->name;
                $addgoods->url = $request->url;
                $addgoods->save();
            }else{
                $addgoods = new Goods;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $addgoods->user_id = $id;
                $addgoods->name = $request->name;
                $addgoods->url = $request->url;
                $addgoods->save();
            }
        }
        return redirect("user/{$id}/goods");
    }
    //削除
    public function del(Request $request, $id, $goods_id) {
        $data = Goods::find($goods_id);
        return view('Goods.del', compact('data'));
    }

    public function remove(Request $request, $id, $goods_id) {
        // レコードを削除する。
        Goods::find($goods_id)->delete();
        return redirect("/user/{$id}/goods");
    }
    //複数選択削除
    public function multi_del(Request $request, $id) {
        $data = array();    //配列の初期化
        $check_goods = $request->input('check_goods');  //チェックボックスのデータを取得
        foreach($check_goods as $item){
            $data[] = Goods::where('id',$item)->first();    //where('カラム名','任意')
        }
        return view('goods.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        $goods_id = $request->input('goods_id');
        foreach($goods_id as $item){
            Goods::where('id',$item)->delete();
        }
        return redirect("/user/{$id}/goods");
    }
}

