<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocateTag extends Model
{
    protected $table = 'locate_tags';

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        return parent::resolveChildRouteBinding($childType, $value, $field);
    }

    public function user(){
        return $this->belongsToMany('App\User', 'user_locate_tags', 'tag_id', 'user_id');
    }
}
