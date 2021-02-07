<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function user(){
        return $this->belongsToMany('App\User', 'user_cities', 'city_id', 'user_id');
    }
}
