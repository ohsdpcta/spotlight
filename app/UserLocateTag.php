<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocateTag extends Model
{
    protected $table = 'user_locate_tags';
    protected $guarded = array('id');

    public function user(){
        return $this->belongsTo('App\User');
    }
}
