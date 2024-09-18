<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return $next($request);
            } else {
                // Check if the current route is 'jadwal'
                if ($request->routeIs('listjadwal')) {
                    return redirect()->route('listjadwal')->withErrors('Maaf Anda Tidak Mempunyai Akses Sebagai Administrator')->withInput();
                }
                return redirect()->route('dashboard')->withErrors('Maaf Anda Tidak Mempunyai Akses Sebagai Administrator')->withInput();
            }
        } else {
            return redirect()->route('login')->withErrors('Tidak Mempunyai Akses Silahkan Login Dahulu')->withInput();
        }
    }
}
