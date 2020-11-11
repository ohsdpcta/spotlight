<?php

namespace App\Library;
use Illuminate\Support\Facades\Auth;

class UserClass{
  public static function getLoginUser(){
    if(Auth::user()){
      $user = Auth::user();
    }else{
      $user = '';
    }
    return $user;
  }
}