<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccountIsAdmin
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
        if (Auth::guard('provider')->user()->role != 'admin') {
            abort(403);
        }

        return $next($request);
    }
}