<?php

namespace App\Http\Middleware;

use Closure;

class Mailvarification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->status == config('const.USER_STATUS.MAIL_AUTHED')){
            return $next($request);
        }
        return redirect('/');
    }
}
