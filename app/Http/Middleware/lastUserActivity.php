<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Cache;
use Carbon\carbon;
use Illuminate\Support\Facades\Auth;

class lastUserActivity
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
        if(Auth::check()){
            $expiresAt=Carbon::now()->addMinutes(1);
               Cache::put('user-is-online'.auth()->guard('admin')->user()->id, true,$expiresAt);

        }
        return $next($request);
    }
}
