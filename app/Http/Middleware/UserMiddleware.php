<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(session('user'))){
            return redirect()->route('user.auth');
        }else{
            return $next($request);
        }
    }
}
