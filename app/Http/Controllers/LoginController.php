<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        // Jika user sudah login, arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('landing.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin, $request->remember)) {
            return redirect()->route('dashboard'); // Redirect ke dashboard setelah login
        } else {
            return redirect()->route('login')->withErrors('Username dan Password salah')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/')->withErrors('Berhasil Logout!')->withInput();
    }
}
