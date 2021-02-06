<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Library\LocateClass;

use App\Locate;
use App\Prefecture;
use App\UserPrefecture;
use App\City;
use App\UserCity;

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
        $locate_data = Locate::where('user_id', $id)->first();
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
        $prefecture = Prefecture::where('name', $formatted_address[1])->first();
        $city = City::where('name', $formatted_address[2])->first();
        //タグの名前がDBになかった場合、タグを新たに登録
        if(empty($prefecture)){
            $prefecture = new Prefecture;
            $prefecture->name = $formatted_address[1];
            $prefecture->save();
        }
        if(empty($city)){
            $city = new City;
            $city->name = $formatted_address[2];
            $city->save();
        }
        $id = Auth::id();
        UserPrefecture::where('user_id', $id)->delete();
        $user_pref = new UserPrefecture;
        $user_pref->user_id = $id;
        $user_pref->prefecture_id = $prefecture->id;
        UserCity::where('user_id', $id)->delete();
        $user_city = new UserCity;
        $user_city->user_id = $id;
        $user_city->city_id = $city->id;

        $locate = Locate::where('user_id', Auth::id())->first();
        if($locate){
            $locate->coordinate = $request->coordinate;
        }else{
            $locate = new Locate;
            $locate->user_id = Auth::id();
            $locate->coordinate = $request->coordinate;
        }
        if($locate->save() && $user_pref->save() && $user_city->save()){
            session()->flash('flash_message', 'ロケーションの設定が完了しました');
        }else{
            session()->flash('flash_message_error', 'ロケーションの設定が失敗しました');
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
}