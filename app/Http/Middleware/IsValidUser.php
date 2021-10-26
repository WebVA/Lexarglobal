<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsValidUser
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
        if(session('is_logged')) {
            return $next($request);
        }
        else {
            return redirect()->route('first');
        }
    }
}
