<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ActiveMiddleware
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
        if (Auth::user()->estado == 'activo')
        {
            return $next($request);
        }
        else
        {
            return view('errors/banned');
        }
    }
}
