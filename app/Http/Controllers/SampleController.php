<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $addsample->user_id = $id;
        $this->authorize('edit', $addsample);
        // //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25',
            'url'=>'required|between:1,190|url',
        ];
        $messages = [
            'name.required' => 'サンプル名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
            'url.required' => 'URLを入力してください',
            'url.between' => '１９０文字以内で入力してください。',
            'url.url' => 'URLを正しく入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/sample/add")
                ->withErrors($validator)
                ->withInput();
        }
        $sample = $validator->validate();
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
        $sample = new Sample;
        $sample->user_id = $id;
        $this->authorize('edit', $sample);
        // //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25',
            'url'=>'required|between:1,190|url',
        ];
        $messages = [
            'name.required' => 'サンプル名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
            'url.required' => 'URLを入力してください',
            'url.between' => '１９０文字以内で入力してください。',
            'url.url' => 'URLを正しく入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/sample/{$sample_id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $sample = $validator->validate();
        if(Auth::id() == $id){
            $addsample = Sample::find($sample_id);
            $addsample->name = $request->name;
            $addsample->url = $request->url;
            if($addsample->save()){
                session()->flash('flash_message', 'サンプルの編集が完了しました');
            }
        }
        return redirect("user/{$id}/summary/sample");
    }

    // 削除確認画面
    public function delete(Request $request, $id) {
        if(empty($request->checked_items)){
            session()->flash('flash_message_error', '削除したい項目にチェックを入れてください');
            return redirect("/user/{$id}/summary/sample");
        }
        $checked_id_str = implode(',', $request->checked_items);
        $data = Sample::find($request->checked_items);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        return view('summary.delete_sample', compact('data', 'checked_id_str'));
    }
    // 削除処理
    public function remove(Request $request, $id) {
        $delete_item_id = explode(',', $request->checked_id_str);
        $data = Sample::find($delete_item_id);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        $data->each->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect("/user/{$id}/summary/sample");
    }
}
