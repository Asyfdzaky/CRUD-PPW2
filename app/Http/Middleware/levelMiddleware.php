<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class levelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::check() && Auth::user()->level != 'admin' && Auth::user()->level != 'internal_reviewer') {
            return redirect()->back(); // Mengembalikan pengguna non-admin
        }
        return $next($request); // Melanjutkan jika pengguna adalah admin
    }
}
