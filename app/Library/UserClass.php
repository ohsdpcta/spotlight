<?php

namespace App\Library;

use App\User;
use App\Tag;
use App\Follower;
use App\Paypay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

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

  public static function get_paypay_url($id){
    $target = Paypay::where('user_id', $id)->first();
    if($target){
      $url = $target->url;
    }else{
      $url = '';
    }
    return $url;
  }

  //ユーザーのidからタグを取得する
  public static function getTag($id){
    $user = User::find($id);
    $tag = $user->tag()->get();
    return $tag;
  }

  // //タグidからユーザーを取得する
  // public static function getTagtoUser($id){
  //   $tag = Tag::find($id);
  //   $user = $tag->
  // }
}

