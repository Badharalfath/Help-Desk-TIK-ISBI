@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Tambah Barang</h2>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="kd_barang" class="block text-gray-700">Kode Barang</label>
                <input type="text" id="kd_barang" name="kd_barang" value="{{ $kodeOtomatis }}" class="border p-2 w-full" readonly>
            </div>
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="kd_kategori" class="block text-gray-700">Kategori</label>
                <select id="kd_kategori" name="kd_kategori" class="border p-2 w-full" required>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->kode }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
