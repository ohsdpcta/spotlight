<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\User;//一応入れた
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
//-----------------------------------------------------------------------------------
    // 一覧
    public function summary(){
        $data = User::select()
            ->join('user_tag','user_tag.user_id','=','user.id')
            ->get();
            return view('summary.tag', compact('data'));
    }

    //新規追加
    public function add(Request $request, $id){
        $tag = new Tag;
        $tag->id = $id;
        $this->authorize('edit', $tag);
        return view('summary.add_tag');
    }

    public function create(Request $request, $id){
        $tag = new Tag;
        $tag->id = $id;
        $this->authorize('edit', $tag);
        // //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25'
        ];
        $messages = [
            'name.required' => 'タグ名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/tag/add")
                ->withErrors($validator)
                ->withInput();
        }
        $tag = $validator->validate();

        $addtag->name = $request->name;
        if($addtag->save()){
            session()->flash('flash_message', 'グッズの登録が完了しました');
        }
        return redirect("user/{$id}/summary/tag");
    }

//-------------------------------------------------------------------------------------
//以下goodsのコピー

    // 削除確認画面
    public function delete(Request $request, $id) {
        if(empty($request->checked_items)){
            session()->flash('flash_message_error', '削除したい項目にチェックを入れてください');
            return redirect("/user/{$id}/summary/tag");
        }
        $checked_id_str = implode(',', $request->checked_items);
        $data = Tag::find($request->checked_items);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        return view('summary.delete_tag', compact('data', 'checked_id_str'));
    }
    // 削除処理
    public function remove(Request $request, $id) {
        $delete_item_id = explode(',', $request->checked_id_str);
        $data = Tag::find($delete_item_id);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        $data->each->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect("/user/{$id}/summary/tag");
    }
}
