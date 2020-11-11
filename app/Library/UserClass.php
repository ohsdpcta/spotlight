<?php

namespace App\Library;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserClass{
  public static function getUser($id){
    $user = User::find($id);
    return $user;
  }
}