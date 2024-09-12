@extends('layouts.homedash')

@section('content')
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
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Email</th>
                    <th class="py-2 px-4 border-b text-left">Nama</th>
                    <th class="py-2 px-4 border-b text-left">Role</th>
                    <th class="py-2 px-4 border-b text-right pr-[70px]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b text-right">
                            <!-- Edit -->
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="inline-block bg-yellow-500 text-white py-2 px-4 rounded text-sm font-medium mr-2 hover:bg-yellow-600">
                                Edit
                            </a>
                            <!-- Delete -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white py-2 px-4 rounded text-sm font-medium hover:bg-red-600"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </body>

    </html>
@endsection
