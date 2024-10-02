@extends('layouts.homedash')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>
    <form action="{{ route('kategori.update', $kategori->kd_kategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="kd_kategori" class="block text-gray-700">Kode Kategori</label>
            <input type="text" id="kd_kategori" name="kd_kategori" value="{{ $kategori->kd_kategori }}" class="border p-2 w-full" readonly>
        </div>
        <div class="mb-4">
            <label for="nama_kategori" class="block text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="qty_barang" class="block text-gray-700">Jumlah Barang</label>
            <input type="number" id="qty_barang" name="qty_barang" value="{{ $kategori->qty_barang }}" class="border p-2 w-full" readonly>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection
