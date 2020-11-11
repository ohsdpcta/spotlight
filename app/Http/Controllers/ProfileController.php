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
        // フォロー処理
        $follow = Follower::where('target_id', $id)
            ->where('follower_id', Auth::id())
            ->get();
        if(count($follow)>=1){
            $follow_flg = 1;
        }else{
            $follow_flg = 0;
        }
        $follower = Follower::where('target_id', $id)->get();

        return view('profile.profile', compact('data', 'follow_flg', 'follower'));
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
