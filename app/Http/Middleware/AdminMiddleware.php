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
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki role admin
        if (Auth::user()->role !== 'admin') {
            // Redirect ke halaman home dengan pesan error
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman Admin!');
        }

        return $next($request);
    }
}