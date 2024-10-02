@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4 ">
        <h2 class="text-left text-xl font-semibold">Daftar Lokasi</h2>
        <!-- Search Form -->
        <form method="GET" action="{{ route('lokasi') }}" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama lokasi atau departemen"
                    class="px-4 py-2 border rounded w-full" />
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Cari
                </button>
                <a href="{{ route('lokasi') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('lokasi.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah Lokasi</a>
        </div>
    </div>
    <hr class="mb-6">
    <div class="content">
        <!-- Konten akan ditambahkan di sini -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Kode</th>
                    <th class="py-2 px-4 border-b text-left">Nama Lokasi</th>
                    <th class="py-2 px-4 border-b text-left">Departemen</th>
                    <th class="py-2 px-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasi as $l)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $l->kode }}</td>
                        <td class="py-2 px-4 border-b">{{ $l->nama_lokasi }}</td>
                        <td class="py-2 px-4 border-b">{{ $l->departemen->nama_departemen }}</td>
                        <td class="py-2 px-4 border-b text-right">
                            <a href="{{ route('lokasi.edit', $l->kode) }}"
                                class="bg-yellow-500 text-white py-2 px-4 rounded">Edit</a>
                            <form action="{{ route('lokasi.destroy', $l->kode) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded"
                                    onclick="return confirm('Yakin ingin menghapus lokasi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection