<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    public function user(){
        return $this->belongsToMany('App\User', 'user_prefectures', 'prefecture_id', 'user_id');
    }
}
