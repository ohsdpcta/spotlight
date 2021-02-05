<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Library\LocateClass;
use App\Library\UserClass;

use App\User;
use App\Locate;
use App\LocateTag;
use App\UserLocateTag;

class LocateController extends Controller
{
    // gmap表示
    public function index(Request $request, $id) {
        $locate_data = Locate::where('user_id', $id)->first();
        if(!empty($locate_data->coordinate)){
            $locate_array = explode(',', $locate_data->coordinate);
        }else{
            $locate_array = [];
        }
        return view('index.locate', compact('locate_array'));
    }

    //ロケーション+住所登録フォーム
    public function edit(Request $request, $id){
        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);
        if(!empty($locate_data->coordinate)){
            $locate_array = explode(',', $locate_data->coordinate);
        }else{
            $locate_array = [];
        }
        return view('summary.edit_locate', compact('locate_array'));
    }

    //ロケーション+住所登録
    public function update(Request $request, $id){
        // バリデーションの設定
        $rules = [
            'coordinate'=>'required|regex:/^[-\d]\d{0,2}.\d{5,30},[-\d]\d{0,3}.\d{5,30}$/',
        ];
        $messages = [
            'coordinate.required' => '登録したい場所をクリックしてください。',
            'coordinate.regex' => '入力欄に座標が入っていることを確認してから、もう一度登録してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/locate")
                ->withErrors($validator)
                ->withInput();
        }

        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);


        $formatted_address = LocateClass::regex_address($request->address);
        $locate_tag = LocateTag::where('city_tag_name', $formatted_address[2])->first();//タグの名称が一致するものがあった場合、そのタプルを取り出している
        //タグの名前がDBになかった場合、タグを新たに登録
        if(empty($locate_tag)){
            $locate_tag = new LocateTag;
            $locate_tag->prefecture_tag_name = $formatted_address[1];    //tagテーブルのtag_nameカラムに
            $locate_tag->city_tag_name = $formatted_address[2];
            $locate_tag->save();
        }
        $id = Auth::id();
        //user_idとtag_idが共に一致するカラムがある場合には、削除して再登録(タグ名は前の分岐で一意に定まっているため、user_idだけ比較)
        if($locate_tag_re_register = UserLocateTag::where('user_id', $id)->where('tag_id', $locate_tag->id)->first()){
            $locate_tag_re_register->delete();
        }
        //タグとユーザーの関連付け
        $user_locatetag = new UserLocateTag;
        $user_locatetag->user_id = $id;
        $user_locatetag->tag_id = $locate_tag->id;

        $locate = Locate::where('user_id', Auth::id())->first();
        if($locate){
            $locate->coordinate = $request->coordinate;
        }else{
            $locate = new Locate;
            //Auth::はログインしているユーザーのデータを持ってこれるコマンド
            $locate->user_id = Auth::id();
            $locate->coordinate = $request->coordinate;
        }
        if($locate->save() and $user_locatetag->save()){
            session()->flash('flash_message', 'ロケーションの設定が完了しました');
        }
        return redirect("/user/{$id}/summary/locate");
    }

    public function remove(Request $request,$id){
        // レコードを削除する。
        $locate = new Locate;
        $locate->user_id = $id;
        $this->authorize('edit', $locate);
        if(Locate::where('user_id', Auth::id())->delete()){
            session()->flash('flash_message', 'ロケーションを削除しました');
        }
        return redirect("/user/{$id}/summary/locate");
    }

    public function locate_tag_search(Request $request){
        $locate_tag = LocateTag::find($request->tag_id);
        $users = $locate_tag->user; //ここのuserがわからず。

        $user = new LengthAwarePaginator(
            $users->forPage($request->page,2),  // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            count($users),  //総件数
            2,  //1ページあたりの件数。(本来なら20。確認用)
            $request->page,  // 現在のページ(ページャーの色がActiveになる)
            array('path'=>"/user/locate_tag_search?tag_id=$locate_tag->prefecture_name_tag, $locate_tag->city_name_tag") // ページャーのリンクをOptionのpathで指定
        );

        return view('search_locate', ['result' => $user]);//$○○→id $○○->name
    }
}