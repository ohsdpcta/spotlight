<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    protected $table = 'user_tags';
    protected $guarded = array('id');

    public function user(){
        return $this->belongsTo('App\User');
    }
}
