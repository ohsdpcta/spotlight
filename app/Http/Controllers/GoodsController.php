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
        $this->authorize('edit', $addgoods);
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
        $this->authorize('edit', $data);
        return view('summary.edit_goods',compact('data'));
    }
    public function update(Request $request, $id, $goods_id){
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $this->authorize('edit', $addgoods);
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

    // 削除確認画面
    public function delete(Request $request, $id) {
        $checked_id_str = implode(',', $request->checked_items);
        $data = Goods::find($request->checked_items);
        if(empty($data)){
            session()->flash('flash_message_error', '削除したい項目にチェックを入れてください');
            return redirect("/user/53/summary/goods");
        }
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        return view('summary.delete_goods', compact('data', 'checked_id_str'));
    }
    // 削除処理
    public function remove(Request $request, $id) {
        $goods_id = explode(',', $request->checked_id_str);
        $data = Goods::find($goods_id);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        $data->each->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect("/user/{$id}/summary/goods");
    }
}
