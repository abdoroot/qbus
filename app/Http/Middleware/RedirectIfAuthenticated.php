<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        if (Auth::guard($guard)->check()) {
            if ($guard == "admin") return redirect(route('admin.home'));

            if ($guard == "provider")  return redirect(route('provider.home'));
            
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
