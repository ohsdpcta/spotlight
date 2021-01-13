<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Follower' => 'App\Policies\FollowerPolicy',
        'App\Profile' => 'App\Policies\ProfilePolicy',
        'App\Locate' => 'App\Policies\LocatePolicy',
        'App\goods' => 'App\Policies\GoodsPolicy',
        'App\Sample' => 'App\Policies\SamplePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
