<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Sample;

class SampleController extends Controller {
    public function index(Request $request, $id) {
        $data = Sample::where('user_id', $id)->paginate(10);
        for ($i=0; $i<count($data); $i++) {
            if ($data[$i]->embed_site == "soundcloud") {
                $data[$i]->url = unserialize($data[$i]->url);
            }
        }
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
        //バリデーションの設定
        $rules = [
            'name'=>['required','between:1,50'],
            'url'=>['required','between:1,1000','regex:/^.*youtube.*|.*soundcloud.*$/'],
        ];
        $messages = [
            'name.required' => 'サンプル名を入力してください。',
            'name.between' => '50文字以内で入力してください。',
            'url.required' => 'urlを入力してください。',
            'url.between' => '1000文字以内で入力してください。',
            'url.regex' => 'URLは【i】のアイコンをクリックし、サンプル登録方法をお選びください',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/sample/add")
                ->withErrors($validator)
                ->withInput();
        }
        $addsample->name = $request->name;
        preg_match( '/youtube|soundcloud/', $request->url, $matches );
        if ($matches[0] == "youtube") {
            $addsample->picture = 'https://spotlight-images01.s3-ap-northeast-1.amazonaws.com/resources/youtube_social_squircle_white.png';
            if (preg_match('/src="(\S+)"/', $request->url, $matches )) {
                $addsample->embed_site = 'youtube';
                $addsample->url = $matches[1];
            } elseif (preg_match("/list=(\S+)/", $request->url, $matches)) {
                $addsample->embed_site = 'youtube_list';
                $addsample->url = $matches[1];
            } else {
                session()->flash('flash_message', '入力内容を確認してもう一度入力してください。');
                return redirect("user/{$id}/summary/sample/add");
            }
        } elseif($matches[0] == 'soundcloud') {
            $addsample->picture = 'https://spotlight-images01.s3-ap-northeast-1.amazonaws.com/resources/th.jpg';
            if (preg_match_all('/src="(\S+)"|href="(\S+)"|title="(\S+|([\S\s]{1,50}) target=)"/', $request->url, $matches)) {
                $addsample->embed_site = 'soundcloud';
                $addsample->url = serialize($matches);
            }
        } else {
            session()->flash('flash_message', '入力内容を確認してもう一度入力してください。');
            return redirect("user/{$id}/summary/sample/add");
        }

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
        $editsample = new Sample;
        $editsample->user_id = $id;
        $this->authorize('edit', $editsample);
        // //バリデーションの設定
        $rules = [
            'name'=>['required','between:1,50'],
            'url'=>['required','between:1,1000','regex:/^.*youtube.*|.*soundcloud.*$/'],
        ];
        $messages = [
            'name.required' => 'サンプル名を入力してください。',
            'name.between' => '50文字以内で入力してください。',
            'url.required' => 'urlを入力してください。',
            'url.between' => '1000文字以内で入力してください。',
            'url.regex' => 'URLは【i】のアイコンをクリックし、サンプル登録方法をお選びください',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/sample/add")
                ->withErrors($validator)
                ->withInput();
        }
        $editsample->name = $request->name;
        preg_match( '/youtube|soundcloud/', $request->url, $matches );
        if ($matches[0] == "youtube") {
            if (preg_match('/src="(\S+)"/', $request->url, $matches )) {
                $editsample = Sample::find($sample_id);
                $editsample->embed_site = 'youtube';
                $editsample->url = $matches[1];
            } elseif (preg_match("/list=(\S+)/", $request->url, $matches)) {
                $editsample = Sample::find($sample_id);
                $editsample->embed_site = 'youtube_list';
                $editsample->url = $matches[1];
            } else {
                session()->flash('flash_message', '入力内容を確認してもう一度入力してください。');
                return redirect("user/{$id}/summary/sample/add");
            }
        } elseif($matches[0] == 'soundcloud') {
            if (preg_match_all('/src="(\S+)"|href="(\S+)"|title="(\S+|([\S\s]{1,50}) target=)"/', $request->url, $matches)) {
                $editsample = Sample::find($sample_id);
                $editsample->embed_site = 'soundcloud';
                $editsample->url = serialize($matches);
            }
        } else {
            session()->flash('flash_message', '入力内容を確認してもう一度入力してください。');
            return redirect("user/{$id}/summary/sample/add");
        }

        if($editsample->save()){
            session()->flash('flash_message', 'サンプルの登録が完了しました');
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
