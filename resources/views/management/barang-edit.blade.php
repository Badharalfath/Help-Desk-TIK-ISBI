@extends('layouts.homedash')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-2xl font-bold mb-4">Edit Barang</h2>
    <form action="{{ route('barang.update', $barang->kd_barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="kd_barang" class="block text-gray-700">Kode Barang</label>
            <input type="text" id="kd_barang" name="kd_barang" value="{{ $barang->kd_barang }}" class="border p-2 w-full" readonly>
        </div>
        <div class="mb-4">
            <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="merek" class="block text-gray-700">Merek</label>
            <input type="text" id="merek" name="merek" value="{{ $barang->merek }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="kd_kategori" class="block text-gray-700">Kategori</label>
            <select id="kd_kategori" name="kd_kategori" class="border p-2 w-full" required>
                @foreach ($kategori as $k)
                    <option value="{{ $k->kd_kategori }}" {{ $barang->kd_kategori == $k->kd_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" value="{{ $barang->jumlah }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-gray-700">Foto Barang</label>
            <input type="file" id="foto" name="foto" class="border p-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection
