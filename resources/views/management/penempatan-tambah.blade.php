@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <h2 class="text-left text-xl font-semibold mb-4">Tambah Penempatan Barang</h2>

    <!-- penempatan-tambah.blade.php -->
<form action="{{ route('penempatan.store') }}" method="POST" class="max-w-lg mx-auto p-4">
    @csrf

    <!-- No. Penempatan (Otomatis) -->
    <div class="mb-4">
        <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penempatan</label>
        <input type="text" id="kd_penempatan" name="kd_penempatan" value="{{ $newKdPenempatan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
    </div>

    <!-- Nama Barang (Dropdown dari Tabel Barang) -->
    <div class="mb-4">
        <label for="kd_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
        <select id="kd_barang" name="kd_barang" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            <option value="">Pilih Barang</option>
            @foreach($barang as $item)
                <option value="{{ $item->kd_barang }}">{{ $item->nama_barang }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tanggal Penempatan -->
    <div class="mb-4">
        <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penempatan</label>
        <input type="date" id="tgl_penempatan" name="tgl_penempatan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
    </div>

    <!-- Keterangan -->
    <div class="mb-4">
        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
        <input type="text" id="keterangan" name="keterangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
    </div>

    <!-- Tombol Simpan -->
    <div class="mt-6">
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Simpan</button>
    </div>
</form>

</div>
@endsection
