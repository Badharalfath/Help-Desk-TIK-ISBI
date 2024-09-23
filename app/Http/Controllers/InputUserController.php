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
        $users = User::all();
        return view('dash.user', compact('users'));
    }

    // Menampilkan form untuk menambah user
    public function create()
    {
        return view('dash.inuser');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan form edit user berdasarkan ID
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dash.edituser', compact('user'));
    }

    // Memperbarui data user berdasarkan ID
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed', // Password bersifat opsional
        ]);

        // Update data user
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    // Menghapus user berdasarkan ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
