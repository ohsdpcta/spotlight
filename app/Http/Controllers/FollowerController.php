<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use App\User;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(Request $request, $id){
        $follower = new Follower;
        $follower->target_id = $id;
        $follower->follower_id = Auth::id();
        $this->authorize('edit', $follower);
        $follower->save();
        return redirect("/user/{$id}/profile");
    }

    public function unfollow(Request $request, $id){
        $follower = new Follower;
        $follower->target_id = $id;
        $this->authorize('edit', $follower);
        Follower::where('target_id', $id)
            ->where('follower_id', Auth::id())
            ->delete();
        return redirect("/user/{$id}/profile");
    }

    public function followlist(Request $request, $id){
        $data = User::find($id)->followees()->get();
        return view('index.followee', compact('data'));
    }

    public function followerlist(Request $request, $id){
        $data = User::find($id)->followers()->get();
        return view('index.follower', compact('data'));
    }
}