<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Follower;

class LocateController extends Controller
{
    public function map(Request $request, $id) {
        // $data = Profile::find($id);
        // // フォロー処理
        // $follow = Follower::where('target_id', $id)
        //     ->where('follower_id', Auth::id())
        //     ->get();
        // if(count($follow)>=1){
        //     $follow_flg = 1;
        // }else{
        //     $follow_flg = 0;
        // }
        // $follower = Follower::where('target_id', $id)->get();

        $data = tekitou::find($id);
        $locate = tekitou::where('taeget_id' $id)
            


        return view('profile.profile', compact('data', 'follow_flg', 'follower'));
    }
}
