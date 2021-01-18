<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Profile;
use App\UserTag;
use Illuminate\Validation\Rule;

class ProfileController extends Controller {
    public function index(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();
        $tag = UserTag::table('user_tags')
        ->join('users', 'user_tags.user_id', '=', 'users.id')
        ->join('tags', 'user_tags.tag_id', '=', 'tags.id')
        ->where('user.id', $id)
        ->select('tag.tag_name')
        ->get();
        return view('index.profile', compact('data', 'tag'));
    }

    public function edit(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $data);
        return view('summary.edit_profile', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $data);
        // //バリデーションの設定
        $rules = [
            'content'=>'required|between:1,20001',
        ];
        $messages = [
            'content.required' => '1文字以上で入力してください。',
            'content.between' => '20,000文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("user/{$id}/summary/profile")
                ->withErrors($validator)
                ->withInput();
        }
        $user = $validator->validate();
        
        $data->content = $request->content;
        if($data->save()){
            session()->flash('flash_message', 'プロフィールの編集が完了しました');
            $id = Auth::id();
        }
        return redirect("user/{$id}/summary/profile");
    }
}
