<?php

namespace app\Http\Middleware;
use Auth;
use Closure;

class Admin {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->isAdmin() )
        {
			return $next($request);
        }

        return response('this page requires that you be logged in and an Admin.', 401);

    }

}