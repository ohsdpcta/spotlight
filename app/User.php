<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use app\Tag;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'social_id','token', 'avatar','email_verified', 'email_verify_token','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile(){
        return $this->belongsTo('App\Profile');
    }

    public function locate(){
        return $this->hasOne('App\Locate');
    }

    public function sprofile(){
        return $this->hasOne('App\SmallProfile');
    }

    public function goods(){
        return $this->hasMany('App\Goods');
    }

    public function sample(){
        return $this->hasMany('App\Sample');
    }

    public function tag(){
        return $this->belongsToMany('App\Tag', 'user_tags', 'user_id', 'tag_id');
    }

    public function followees(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'target_id');
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'target_id', 'follower_id');
    }

    public function newemail(){
        return $this->hasMany('App\Newemail');
    }

    public function prefecture(){
        return $this->belongsToMany('App\Prefecture', 'user_prefectures', 'user_id', 'prefecture_id');
    }

    public function city(){
        return $this->belongsToMany('App\City', 'user_cities', 'user_id', 'city_id');
    }
}
