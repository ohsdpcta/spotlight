<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;

class GoodsController extends Controller
{
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
    public function multi_del(Request $request, $id ) {
        $data = Goods::find($id);
        return view('goods.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        return redirect("/user/{$id}/goods");
    }
}

