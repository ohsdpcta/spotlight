<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\UserTag;
use App\User;//一応入れた
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
//-----------------------------------------------------------------------------------
    // 一覧
    public function summary(Request $request, $id){
        return view('summary.summary_tag');
    }

    //新規追加
    public function add(Request $request, $id){
        $usertag = new UserTag;
        $usertag->user_id = $id;
        $this->authorize('add', $usertag);
        return view('summary.add_tag');
    }

    public function create(Request $request, $id){
        //認証
        $usertag = new UserTag;
        $usertag->user_id = $id;                //user_tagテーブルのuser_idカラムに自分にidを入力
        $this->authorize('add', $usertag);

        //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25'
        ];
        $messages = [
            'name.required' => 'タグ名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{Auth::id()}/summary/tag/add")
                ->withErrors($validator)
                ->withInput();
        }

        $tag = Tag::where('tag_name', $request->name)->first();
        //タグの名前が既にDBに登録されていた場合
        if(empty($tag)){
            $tag = new Tag;
            $tag->tag_name = $request->name;    //tagテーブルのtag_nameカラムに
            if($tag->save()){
                session()->flash('flash_message', 'グッズの登録が完了しました');
            }
        }
        //タグとユーザーの関連付け
        $usertag->tag_id = $tag->id;
            $usertag->save();
            return redirect("user/{$id}/summary/tag");
    }

    //タグとユーザーの関連付けが既に存在していた場合の対応

//-------------------------------------------------------------------------------------
//---------------------------以下goodsのコピー------------------------------------------
//-------------------------------------------------------------------------------------

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
