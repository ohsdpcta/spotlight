<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locate extends Model
{
    protected $table = 'locates';
    protected $guarded = array('id');

    public function user(){
        return $this->hasOne('App\User');
    }
}
