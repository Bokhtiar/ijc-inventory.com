<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /* Handle an incoming request. */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role->id == 2) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
