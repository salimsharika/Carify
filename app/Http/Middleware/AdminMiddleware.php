<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            return $next($request);
        }

        // Redirect to home if not admin
        return redirect('/');
    }
}
