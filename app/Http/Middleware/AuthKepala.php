<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthKepala
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->role == "kepala"){
                return $next($request);
            }else{
                return redirect('dashboard')-> withErrors('Maaf Anda Tidak Mempunyai Akses Sebagai Head Office')->withInput();
            }

        }else{
            return redirect('login')-> withErrors('Tidak Mempunyai Akses Silahkan Login Dahulu')->withInput();
        }
    }
}
