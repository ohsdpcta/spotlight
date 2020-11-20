<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sample;

class SampleController extends Controller
{
    public function index(Request $request, $id) {
        $data = Sample::find($id)->paginate(10);
        return view('sample.sample', compact('data'));
    }

    public function summary(Request $request, $id){
        $data = Sample::find($id)->paginate(10);
        return view('summary.summary_sample', compact('data'));
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
    //編集
    public function edit(Request $request,$id,$user_id)
    {
        $data = Sample::find($user_id);
        return view('sample.edit',compact('data'));
    }
    public function update(Request $request,$id,$user_id)
    {
        if(Auth::id() == $id){
            $addsample = Sample::where('user_id', Auth::id())->first();
            if($addsample){
                $addsample->name = $request->name;
                $addsample->url = $request->url;
                $addsample->save();
            }else{
                $addsample = new Sample;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $addsample->user_id = $id;
                $addsample->name = $request->name;
                $addsample->url = $request->url;
                $addsample->save();
            }
        }
        return redirect("user/{$id}/sample");
    }

    public function del(Request $request, $id,$user_id) {
        $data = Sample::find($user_id);
        return view('sample.del', compact('data'));
    }

    public function remove(Request $request, $id,$user_id) {
        // レコードを削除する。
        Sample::find($user_id)->delete();
        return redirect("/user/{$id}/sample");
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
