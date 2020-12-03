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

  public static function get_paypay_url($id){
    $target = Paypay::where('user_id', $id)->first();
    if($target){
      $url = $target->url;
    }else{
      $url = '';
    }
    return $url;
  }

  // public static function getTag($id){
  //   $tags = \App\Tag::with('users')->find($id);
  //   return $tags;
  // }
  // public static function getTag($id){
  //   $tags =\app\Tag::with(['tag' => function($id){
  //     $id->where('id', '==', $id);
  //   }])->get();
  //   return $tags;
  // }

  // 引数の$idは、各ユーザーのid
  public static function getTag($id)
  {
    // $tags = User::with(['tags'])->find($id);
    // $tags = User::where('id',$id)->first();
    // $tags = Arr::dot($tags);
    // $tags = $this->belongsToMany('App\Tag')->withPivot('tag_name');
    
    // $tags = App\Tag::with('tag_name')->get();
    // foreach ($tags as $tag) {
    //     echo $tags->tags->tag_name;
    // }

    $tags = App\User::find($id)->

    logger($tags);
    return $tags;
  }

  // https://blog.hiroyuki90.com/articles/laravel-with/ ←ここを見ながらやった
}