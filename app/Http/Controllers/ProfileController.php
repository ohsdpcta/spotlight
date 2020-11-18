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
        $data = Profile::where('user_id', $id)->first();
        return view('profile.profile', compact('data'));
    }

    public function edit(Request $request, $id) {
        $data = Profile::where('user_id', $id)->first();
        return view('summary.edit_profile', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = Profile::where('user_id', $id)->first();
        $data->content = $request->content;
        $data->save();

        return redirect("user/{$id}/summary/profile");
    }
}
