@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-left text-xl font-semibold">Daftar Barang</h2>
        <!-- Search Form -->
        <form method="GET" action="{{ route('barang') }}" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama barang atau kategori"
                    class="px-4 py-2 border rounded w-full" />
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Cari
                </button>
                <a href="{{ route('barang') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah Barang</a>
        </div>
    </div>
    <hr class="mb-6">
    <div class="content">
        <!-- Success message -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Kode</th>
                    <th class="py-2 px-4 border-b text-left">Nama Barang</th>
                    <th class="py-2 px-4 border-b text-left">Merek</th>
                    <th class="py-2 px-4 border-b text-left">Kategori</th>
                    <th class="py-2 px-4 border-b text-left">Jumlah</th>
                    <th class="py-2 px-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $b)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $b->kd_barang }}</td>
                        <td class="py-2 px-4 border-b">{{ $b->nama_barang }}</td>
                        <td class="py-2 px-4 border-b">{{ $b->merek }}</td>
                        <td class="py-2 px-4 border-b">{{ $b->kategori->nama_kategori }}</td>
                        <td class="py-2 px-4 border-b">{{ $b->jumlah }}</td>
                        <td class="py-2 px-4 border-b text-right">
                            <a href="{{ route('barang.edit', $b->kd_barang) }}"
                                class="bg-yellow-500 text-white py-2 px-4 rounded">Edit</a>
                            <form action="{{ route('barang.destroy', $b->kd_barang) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded"
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
