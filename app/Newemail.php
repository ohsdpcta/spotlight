<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newemail extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'newemail';

    public function user(){
        return $this->belongsTo('App\User');
    }

}
