<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sample;

class SampleController extends Controller
{
    public function sample(Request $request, $id) {
        $data = Sample::where('user_id', $id)->get();
        return view('sample.sample', compact('data'));
    }

    public function add(Request $request) {
        return view('sample.add');
    }

    public function create(Request $request, $id) {
        // レコードを追加する。
        $addsample = new Sample;
        $addsample->user_id = $id;
        $addsample->name = $request->name;
        $addsample->url = $request->url;
        $addsample->save();
        return redirect("user/{$id}/sample");
    }

    public function del(Request $request, $id) {
        $data = Sample::where('id', $id)->get();
        return view('sample.del', compact('data'));
    }

    public function remove(Request $request, $id) {
        // レコードを削除する。
        $return = Sample::find($id);
        Sample::where('id', $id)->delete();
        return redirect("/user/{$return->user_id}/sample");
    }
        //複数選択削除
    public function multi_del(Request $request, $id) {
        $data = array();    //配列の初期化
        $check_sample = $request->input('check_sample');  //チェックボックスのデータを取得
        foreach($check_sample as $item){
            //where('カラム名','任意')
            $data[] = Sample::where('id',$item)->first();
        }
        return view('sample.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        $sample_id = $request->input('sample_id');
        foreach($sample_id as $item){
            Sample::where('id',$item)->delete();
        }
        return redirect("/user/{$id}/sample");
    }
}
