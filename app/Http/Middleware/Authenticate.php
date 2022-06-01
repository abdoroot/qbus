<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Request::is('admin/*')){
                return route('admin.login');
            }
            if(Request::is('provider/*')){
                return route('provider.login');
            }

            if(Request::is('api/v1/*')){
                return route('error_api_login');
            }


            return route('login');
        }
    }
}
