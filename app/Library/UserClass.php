<?php

namespace App\Library;

use App\User;
use App\Follower;
use App\Paypay;
use Illuminate\Support\Facades\Auth;

class UserClass{
  public static function getUser($id){
    $user = User::find($id);
    return $user;
  }

  public static function getFollower($id){
    // フォロー処理
    $follower = count(Follower::where('target_id', $id)->get());
    $follow = Follower::where('target_id', $id)
      ->where('follower_id', Auth::id())
      ->get();
    if(count($follow)>=1){
        $follow_flg = 1;
    }else{
        $follow_flg = 0;
    }
    $follow_data = [
      'follower' => $follower,
      'follow_flg' => $follow_flg,
    ];
    return $follow_data;
  }

  public static function get_paypay_url($id){
    $target = Paypay::where('user_id', $id)->first();
    if($target){
      $url = $target->url;
    }else{
      $url = '';
    }
    return $url;
  }
}