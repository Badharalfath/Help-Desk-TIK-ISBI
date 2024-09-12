@extends('layouts.homedash')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div class="text-xl font-bold">Dashboard Admin</div>
            <div>
                <a href="#" class="text-gray-300 hover:text-white px-3">Home</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Profile</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Settings</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-10">
        <h2 class="text-2xl font-bold mb-5">Daftar Pengguna</h2>

        <!-- Button tambah user -->
        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah Pengguna</a>
        </div>

        <!-- Tabel daftar users -->
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                    <td class="py-2 px-4 border-b">
                        <!-- Edit -->
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded">Edit</a>
                        <!-- Delete -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
