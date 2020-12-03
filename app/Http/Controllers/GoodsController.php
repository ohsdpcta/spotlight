<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Profile;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    // 一覧
    public function index(Request $request, $id){
        $data = Goods::where('user_id', $id)->paginate(10);
        return view('index.goods', compact('data'));
    }

    public function summary(Request $request, $id){
        $data = Goods::where('user_id', $id)->paginate(10);
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('summary.summary_goods', compact('data'));
    }

    //新規追加
    public function add(Request $request, $id){
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('summary.add_goods');
    }

    public function create(Request $request, $id){
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $addgoods->name = $request->name;
        $addgoods->url = $request->url;
        if($addgoods->save()){
            session()->flash('flash_message', 'グッズの登録が完了しました');
        }
        return redirect("user/{$id}/summary/goods");
    }
    //編集
    public function edit(Request $request, $id, $goods_id){
        $data = Goods::find($goods_id);
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('summary.edit_goods',compact('data'));
    }
    public function update(Request $request, $id, $goods_id){
        if(Auth::id() == $id){
            $addgoods = Goods::find($goods_id);
            $addgoods->name = $request->name;
            $addgoods->url = $request->url;
            if($addgoods->save()){
                session()->flash('flash_message', 'グッズの編集が完了しました');
            }
        }
        return redirect("user/{$id}/summary/goods");
    }
    //削除
    public function del(Request $request, $id, $goods_id) {
        $data = Goods::find($goods_id);
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('Goods.del', compact('data'));
    }

    public function remove(Request $request, $id, $goods_id) {
        // レコードを削除する。
        Goods::find($goods_id)->delete();
        return redirect("/user/{$id}/summary/goods");
    }
    //複数選択削除
    public function multi_del(Request $request, $id) {
        $data = array();    //配列の初期化
        $check_goods = $request->input('check_goods');  //チェックボックスのデータを取得
        foreach($check_goods as $item){
            $data[] = Goods::where('id',$item)->first();    //where('カラム名','任意')
        }
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('goods.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        $goods_id = $request->input('goods_id');
        foreach($goods_id as $item){
            Goods::where('id',$item)->delete();
        }
        return redirect("/user/{$id}/summary/goods");
    }
}