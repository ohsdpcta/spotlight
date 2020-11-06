<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(Request $request, $id){
        $follower = new Follower;
        $follower->target_id = $id;
        $follower->follower_id = Auth::id();
        $follower->save();
        return redirect('/');
    }

    public function unfollow(Request $request, $id){
        Follower::where('target_id', $id)
            ->where('follower_id', Auth::id())
            ->delete();
        return redirect('/');
    }
}
