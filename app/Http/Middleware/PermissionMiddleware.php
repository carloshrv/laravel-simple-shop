<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $Auth;

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
        } else {
            return view('errors.401');
        }
        
        return $next($request);
    }
}
