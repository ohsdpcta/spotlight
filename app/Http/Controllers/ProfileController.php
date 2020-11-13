<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\UserClass;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Profile;
use App\Follower;

class ProfileController extends Controller{
    public function profile(Request $request, $id) {
        $data = Profile::find($id);
        return view('profile.profile', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data = Profile::find($id);
        return view('profile.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = Profile::find($request->id);
        $data -> content = $request->input('変更内容');
        $data->save();

        return redirect("user/{$id}/profile");
    }
}
