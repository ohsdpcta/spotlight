<?php

namespace App\Http\Middleware;

use Closure;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Auth;

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

        if($user->status == '2'){
            return $next($request);
        }
        session()->flash('flash_message_error', 'メールアドレスの確認をしてください');
        return redirect(url()->previous());
    }
}
