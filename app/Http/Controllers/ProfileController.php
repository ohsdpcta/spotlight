<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;

class ProfileController extends Controller {
    public function index(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();
        return view('index.profile', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();
        $this->authorize('edit', $data);
        return view('summary.edit_profile', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = Profile::where('user_id', $id)->first();
        $data->content = $request->content;
        if($data->save()){
            session()->flash('flash_message', 'プロフィールの編集が完了しました');
        }
        return redirect("user/{$id}/summary/profile");
    }
}
