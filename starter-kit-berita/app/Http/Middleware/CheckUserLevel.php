<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$levels  // Menggunakan "rest parameter" untuk menerima beberapa level
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Cek apakah user sudah login dan levelnya ada di dalam daftar $levels yang diizinkan
        if (!Auth::check() || !in_array(Auth::user()->level, $levels)) {
            // Jika tidak, kembalikan halaman error 403 (Forbidden)
            abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        return $next($request);
    }
}