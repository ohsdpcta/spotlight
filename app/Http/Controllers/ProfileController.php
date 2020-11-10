<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;

class ProfileController extends Controller
{
    public function profile(Request $request, $id) {
        $data = Profile::find($id);
        $user_id = $data->user_id;
        return view('profile.profile', compact('data', 'user_id'));
    }

    public function edit(Request $request, $id) {
        $data = Profile::find($id);
        return view('profile.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        // dataに値を設定
        $data = Profile::find($request->id);
        $data->content = $request->content;
        $data->save();

        return redirect("user/{$id}/profile");
    }
}
