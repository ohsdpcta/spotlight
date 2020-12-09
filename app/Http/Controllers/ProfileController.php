<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Profile;
use Illuminate\Mail\Markdown;

use Illuminate\Validation\Rule;

class ProfileController extends Controller {
    public function index(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();

        $markdown = Markdown::parse(e($data->content));
        logger(now());
        return view('index.profile', compact('markdown'));
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
            'content'=>'required|between:1,150',
        ];
        $messages = [
            'content.required' => '１文字以上を入力してください。',
            'content.between' => '入力文字数を超えています。',
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
