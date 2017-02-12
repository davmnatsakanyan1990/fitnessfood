<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                switch($guard){
                    case 'trainer' :
                        return redirect()->guest('trainer/login/'.App::getLocale());
                    break;
                    case 'admin' :
                        return redirect()->guest('admin/login/'.App::getLocale());
                    break;
                }

            }
        }

        return $next($request);
    }
}
