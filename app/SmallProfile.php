<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmallProfile extends Model
{
    protected $table = 'smallprofile';
    protected $guarded = array('id');

    public function user(){
        return $this->belongsTo('App\User');
    }
}
