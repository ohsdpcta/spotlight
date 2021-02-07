<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Profile;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//aws s3アップロード
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Filesystem;

class GoodsController extends Controller
{
    // 一覧
    public function index(Request $request, $id){
        $data = Goods::where('user_id', $id)->paginate(10);
        return view('index.goods', compact('data'));
    }

    public function summary(Request $request, $id){//一覧画面
        $data = Goods::where('user_id', $id)->paginate(10);
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        logger($data);
        return view('summary.summary_goods', compact('data'));
    }

    //新規追加
    public function add(Request $request, $id){//追加画面
        $goods = new Goods;
        $goods->user_id = $id;
        $this->authorize('edit', $goods);
        return view('summary.add_goods');
    }

    public function create(Request $request, $id){//追加
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $this->authorize('edit', $addgoods);
        //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25',
            'url'=>'required|between:1,190|url',
        ];
        $messages = [
            'name.required' => 'グッズ名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
            'url.required' => 'URLを入力してください',
            'url.between' => '１９０文字以内で入力してください。',
            'url.url' => 'URLを正しく入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/goods/add")
                ->withErrors($validator)
                ->withInput();
        }

        //画像アップロード
        if(request('goods_picture')){
            $random = Str::random(32);
            $goods_picture = $request->file('goods_picture');
            $path = Storage::disk('s3')->putFile("goods/{$random}", $goods_picture, 'public');
        }
        $addgoods->name = $request->name;
        $addgoods->url = $request->url;
        if(request('goods_picture')){
            $addgoods->picture = Storage::disk('s3')->url($path);
        }
        if($addgoods->save()){
            session()->flash('flash_message', 'グッズの登録が完了しました');
        }
        return redirect("user/{$id}/summary/goods");
    }
    //編集
    public function edit(Request $request, $id, $goods_id){
        $data = Goods::find($goods_id);
        $this->authorize('edit', $data);
        return view('summary.edit_goods',compact('data'));
    }
    public function update(Request $request, $id, $goods_id){
        $addgoods = new Goods;
        $addgoods->user_id = $id;
        $this->authorize('edit', $addgoods);
        // //バリデーションの設定
        $rules = [
            'name'=>'required|between:1,25',
            'url'=>'required|between:1,190|url',
        ];
        $messages = [
            'name.required' => 'グッズ名を入力してください。',
            'name.between' => '２５文字以内で入力してください。',
            'url.required' => 'URLを入力してください',
            'url.between' => '１９０文字以内で入力してください。',
            'url.url' => 'URLを正しく入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/goods/{$goods_id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        if(Auth::id() == $id){
            $addgoods = Goods::find($goods_id);
            $addgoods->name = $request->name;
            $addgoods->url = $request->url;
            if($addgoods->save()){
                session()->flash('flash_message', 'グッズの編集が完了しました');
            }
        }
        return redirect("user/{$id}/summary/goods");
    }

    // 削除確認画面
    public function delete(Request $request, $id) {
        if(empty($request->checked_items)){
            session()->flash('flash_message_error', '削除したい項目にチェックを入れてください');
            return redirect("/user/{$id}/summary/goods");
        }
        $checked_id_str = implode(',', $request->checked_items);
        $data = Goods::find($request->checked_items);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        return view('summary.delete_goods', compact('data', 'checked_id_str'));
    }
    // 削除処理
    public function remove(Request $request, $id) {
        $delete_item_id = explode(',', $request->checked_id_str);
        $data = Goods::find($delete_item_id);
        foreach($data as $item){
            $this->authorize('edit', $item);
        }
        $data->each->delete();
        session()->flash('flash_message', '削除が完了しました');
        return redirect("/user/{$id}/summary/goods");
    }
}
