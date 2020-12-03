<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(Request $request, $id){
        $follow_data = Follower::where('target_id', $id)
            ->where('follower_id', Auth::id())
            ->get();
        if(count($follow_data) == 0 and Auth::id() != $id){
            $follower = new Follower;
            $follower->target_id = $id;
            $follower->follower_id = Auth::id();
            $follower->save();
        }
        return redirect("/user/{$id}/profile");
    }

    public function unfollow(Request $request, $id){
        Follower::where('target_id', $id)
            ->where('follower_id', Auth::id())
            ->delete();
        return redirect("/user/{$id}/profile");
    }

    public function followerlist(Request $request, $id){
        $data = Follower::where('target_id', $id)->paginate(10);
        return view('index.followerlist', compact('data'));
    }

    public function followlist(Request $request, $id){
        $data = Follower::where('follower_id', $id)->paginate(10);
        return view('index.followlist', compact('data'));
    }
}
