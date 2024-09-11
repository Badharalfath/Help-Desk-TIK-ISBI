<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InputUserController extends Controller
{
    // Menampilkan form input user
    public function index()
    {
        return view('dash.inuser');
    }

    // Menyimpan data user ke database
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'role' => 'required|in:-,admin,kepala',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Simpan data user ke database
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman create dengan notifikasi sukses
        return redirect()->route('users.create')->with('success', 'User berhasil ditambahkan!');
    }

    // Halaman konfirmasi setelah user berhasil dibuat
    public function create()
    {
        return view('dash.create');
    }
}
