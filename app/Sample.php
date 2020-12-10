<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $table = 'sample';
    protected $guarded = array('id');
    protected $fillable = [
        'checkbox',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
