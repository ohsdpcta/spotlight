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
}

