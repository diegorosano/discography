<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserMiddleware
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
        if (Auth::user()->rol == 'miembro')
        {
            return $next($request);
        }
        else
        {
            return redirect()->back()->withErrors('No tiene permiso para acceder a ese sitio, consulte con el administrador');
        }
    }
}
