<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    protected $table = 'user_tags';
    public function user(){
        return $this->belongsTo('App\User');
    }
}
