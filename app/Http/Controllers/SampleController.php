<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Sample;

class SampleController extends Controller {
    public function index(Request $request, $id) {
        $data = Sample::where('user_id', $id)->paginate(10);
        return view('index.sample', compact('data'));
    }

    public function summary(Request $request, $id){
        $data = Sample::where('user_id', $id)->paginate(10);
        $sample = new Sample;
        $sample->user_id = $id;
        $this->authorize('edit', $sample);
        return view('summary.summary_sample', compact('data'));
    }

    public function add(Request $request, $id) {
        $sample = new Sample;
        $sample->user_id = $id;
        $this->authorize('edit', $sample);
        return view('summary.add_sample');
    }

    public function create(Request $request, $id) {
        // レコードを追加する。
        $addsample = new Sample;
        // $this->authorize('create', $addsample);
        $addsample->user_id = $id;
        $this->authorize('edit', $addsample);
        $addsample->name = $request->name;
        $addsample->url = $request->url;
        if($addsample->save()){
            session()->flash('flash_message', 'サンプルの登録が完了しました');
        }
        return redirect("user/{$id}/summary/sample");
    }
    //編集
    public function edit(Request $request, $id){
        $data = Sample::where('user_id', $id)->first();
        $this->authorize('edit', $data);
        return view('summary.edit_sample',compact('data'));
    }
    public function update(Request $request, $id, $sample_id)
    {
        if(Auth::id() == $id){
            $addsample = Sample::find($sample_id);
            $this->authorize('edit', $addsample);
            $addsample->name = $request->name;
            $addsample->url = $request->url;
            if($addsample->save()){
                session()->flash('flash_message', 'サンプルの編集が完了しました');
            }
        }
        return redirect("user/{$id}/summary/sample");
    }

    public function del(Request $request, $id,$goods_id) {
        $data = Sample::find($goods_id);
        $this->authorize('edit', $data);
        return view('sample.del', compact('data'));
    }

    public function remove(Request $request, $id,$goods_id) {
        // レコードを削除する。
        Sample::find($goods_id)->delete();
        $sample = new Sample;
        $this->authorize('edit', $sample);
        return redirect("/user/{$id}/summary/sample");
    }
        //複数選択削除
    public function multi_del(Request $request, $id) {
        $data = array();    //配列の初期化
        $check_sample = $request->input('check_sample');  //チェックボックスのデータを取得
        foreach($check_sample as $item){
            //where('カラム名','任意')
            $data[] = Sample::where('id',$item)->first();
        }
        $sample = new Sample;
        $this->authorize('edit', $sample);
        return view('sample.multi_del', compact('data'));
    }
    public function multi_remove(Request $request,$id){
        //レコードを複数削除する.
        $sample_id = $request->input('sample_id');
        foreach($sample_id as $item){
            Sample::where('id',$item)->delete();
        }
        $sample = new Sample;
        $this->authorize('edit', $sample);
        return redirect("/user/{$id}/summary/sample");
    }
}
