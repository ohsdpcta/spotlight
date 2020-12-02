<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public function users()
    {
        return $this->hasMany('App\User');
    }

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }
    /**
     * 値を結合する子モデルの取得
     *
     * @param  string  $childType
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        return parent::resolveChildRouteBinding($childType, $value, $field);
    }

    public function publishedUsers(){
        return $this->hasMany('App\User')->where('id', 1);
    }

}
