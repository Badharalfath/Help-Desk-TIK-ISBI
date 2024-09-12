<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InputUserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        // Mengambil semua data user dari database
        $users = User::all();
        return view('dash.user', compact('users')); // Mengirim data user ke view user.blade.php
    }

    // Menampilkan form untuk menambah user
    public function create()
    {
        return view('dash.inuser'); // Mengarahkan ke halaman form untuk menambah user baru
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Menyimpan user baru ke dalam database
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
        ]);

        // Mengarahkan kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan form edit user berdasarkan ID
    public function edit($id)
    {
        // Mengambil data user berdasarkan ID
        $user = User::findOrFail($id);
        return view('dash.edituser', compact('user')); // Mengirim data user ke view edituser.blade.php
    }

    // Memperbarui data user berdasarkan ID
    public function update(Request $request, $id)
    {
        // Mengambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id, // Email harus unik kecuali untuk user saat ini
            'name' => 'required|string|max:255',
            'role' => 'required|string',
        ]);

        // Memperbarui data user
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        // Mengarahkan kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    // Menghapus user berdasarkan ID
    public function destroy($id)
    {
        // Mengambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Menghapus user dari database
        $user->delete();

        // Mengarahkan kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
