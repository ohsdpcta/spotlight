<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    protected $guarded = array('id');

    public function user(){
        return $this->hasOne('App\User');
    }
}
