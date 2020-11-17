<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locate extends Model
{
    protected $table = 'map';
    protected $guarded = array('id');
}
