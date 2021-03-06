<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Library\UserClass;
use App\SmallProfile;

class SmallProfileController extends Controller
{
    public function edit(Request $request, $id) {
        $data = SmallProfile::where('user_id', $id)->first();
        $smallprofile = new SmallProfile;
        $smallprofile->user_id = $id;
        $this->authorize('edit', $smallprofile);
        return view('summary.edit_smallprofile', compact('data'));
    }

    public function update(Request $request, $id) {
        $rules = [
            'scomment'=>'between:1,50',
        ];
        $messages = [
            'scomment.required' => '1文字以上で入力してください。',
            'scomment.between' => '50文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/smallprofile")
                ->withErrors($validator)
                ->withInput();
        }
        $smallprofile = new SmallProfile;
        $smallprofile->user_id = $id;
        $this->authorize('edit', $smallprofile);
        if(Auth::id() == $id){
            $data = SmallProfile::where('user_id', $id)->first();
            if($data){
                $data->scomment = $request->scomment;
            }else{
                $data = new SmallProfile;
                //Auth::はログインしているユーザーのデータを持ってこれるコマンド
                $data->user_id = Auth::id();
                $data->scomment = $request->scomment;
            }
        if($data->save()){
            session()->flash('flash_message', 'ひと言コメントの編集が完了しました');
        }
    }
        return redirect("user/{$id}/summary/smallprofile");
}

    public function remove(Request $request, $id){
        // レコードを削除する。
        $smallprofile = new SmallProfile;
        $smallprofile->user_id = $id;
        $this->authorize('edit', $smallprofile);
        if(SmallProfile::where('user_id', Auth::id())->delete()){
            session()->flash('flash_message', 'コメントを削除しました');
        }
        return redirect("/user/{$id}/summary/smallprofile");
    }

}
