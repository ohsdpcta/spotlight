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

        $tag = Tag::where('tag_name', $request->name)->first();//タグの名称が一致するものがあった場合、そのタプルを取り出している

        //タグの名前がDBになかった場合、タグを新たに登録
        if(empty($tag)){
            $tag = new Tag;
            $tag->tag_name = $request->name;    //tagテーブルのtag_nameカラムに
            if($tag->save()){
                session()->flash('flash_message', 'タグの登録が完了しました');
            }
        }

        $id = Auth::id();
        //user_idとtag_idが共に一致するカラムがある場合には、登録をスキップしたい(タグ名は前の分岐で一意に定まっているため、user_idだけ比較)
        if($tag_rel_equal = UserTag::where('user_id', $id)->where('tag_id', $tag->id)->first()){
            session()->flash('flash_message', '既に登録されています');
        }else{
            //タグとユーザーの関連付け
            $usertag->tag_id = $tag->id;
            $usertag->save();
        }

        return redirect("user/{$id}/summary/tag");
    }

    // 削除確認画面
    public function delete(Request $request, $id) {

        if(empty($request->checked_items)){
            session()->flash('flash_message_error', '削除したい項目にチェックを入れてください');
            return redirect("/user/{$id}/summary/tag");
        }
        $checked_id_str = implode(',', $request->checked_items);
        $data = Tag::find($request->checked_items);//チェックされたタグの値を取得している
        // foreach($data as $item){
        //     $this->authorize('delete', $item);
        // }

        return view('summary.delete_tag', compact('data', 'checked_id_str'));
        //dataにはtagテーブルの削除するタグのタプル
        //checked_id_strには削除したいタグと自分とを関連付けているuser_tagテーブルのid

    }
    // 削除処理
    public function remove(Request $request, $id) {
        $delete_item_id = explode(',', $request->checked_id_str);
        // $data = User::find($delete_item_id);
        // $data = UserTag::find($delete_item_id)->get();
        foreach($delete_item_id as $i){
            $data = UserTag::where('tag_id', $i)->get();
            logger($data);
            $data->each->delete();
        }
        session()->flash('flash_message', '削除が完了しました');
        return redirect("/user/{$id}/summary/tag");
    }

    // タグ検索結果(改変中)
    public function tag_search(Request $request){
        $input = $request->tag_name;
        logger($input);
        // $user_tag = UserTag::where('tag_id', $request->id);//UserTagテーブルのtag_idカラムがtagテーブルのidと一致するものを検索
        // $user = User::find($user_tag->user_id);
        // return view('search_result', ['result' => $request]);


        // if ($input == '') {
        //     $result = User::paginate(10);
        // }else{
        //     $result = User::where('name', 'like', '%'.$input.'%')->paginate(10);
        // }
        // return view('search_result', ['result' => $result]);
    }
}

// タグ削除昨日に認証機能がつけられていない -->
// タグ削除はユーザーとの関連付けのみを削除するため、一度登録されたタグ自体はずっと残る