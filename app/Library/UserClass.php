<?php

namespace App\Library;

use App\User;
use App\Follower;
use App\SmallProfile;
use Illuminate\Support\Facades\Auth;

class UserClass{
  public static function getUser($id){
    $user = User::find($id);
    return $user;
  }

  public static function getFollower($id){
    // フォロー処理
    $follower = count(Follower::where('target_id', $id)->get());
    $follow_count = count(Follower::where('follower_id',$id)->get());//ふぉろー中数表示プログラム
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
      'follow_count' => $follow_count,
    ];
    return $follow_data;
  }

  public static function getFollowList($id){
    $followlist = Follower::where('follower_id', $id)->get();
    return $followlist;
  }

  //ユーザーのidからタグを取得する
  public static function getSmallprofile($id){
    $sprofile = SmallProfile::where('user_id', $id)->first();
    return $sprofile;
  }

  public static function getTag($id){
    $user = User::find($id);
    $tag = $user->tag()->get();
    return $tag;
  }

  public static function getPrefecture($id){
    $user = User::find($id);
    $prefecture = $user->prefecture;
    if(count($prefecture)){
      $result = $prefecture[0];
    }else{
      $result = false;
    }
    return $result;
  }

  public static function getCity($id){
    $user = User::find($id);
    $city = $user->city;
    if(count($city)){
      $result = $city[0];
    }else{
      $result = false;
    }
    return $result;
  }

  public static function getLocate($id){
    $user = User::find($id);
    $locate = $user->locate;
    return $locate;
  }

  public static function hasRecord($id){
    $flg = [
      'locate' => false,
      'goods' => false,
      'sample' => false,
    ];
    $user = User::find($id);
    if($user->locate){
      $flg['locate'] = true;
    }
    if(count($user->goods)){
      $flg['goods'] = true;
    }
    if(count($user->sample)){
      $flg['sample'] = true;
    }
    return $flg;
  }
}

