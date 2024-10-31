<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{   
    // Memeriksa apakah pengguna sedang login dan memiliki level admin
    if (Auth::check() && Auth::user()->level == 'admin') {
        // Lanjutkan ke rute berikutnya jika pengguna adalah admin
        return $next($request);
    }
    
    // Jika bukan admin, arahkan kembali atau tampilkan pesan kesalahan
    return redirect()->route('home')->with('error', 'Akses ditolak. Anda bukan admin.');
}
}
