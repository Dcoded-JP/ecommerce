<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('logged_in') || Session::get('email') !== 'admin@gmail.com') {
            return redirect()->route('index')->with('error', 'Access denied. Admin privileges required.');
        }
        
        return $next($request);
    }
}
