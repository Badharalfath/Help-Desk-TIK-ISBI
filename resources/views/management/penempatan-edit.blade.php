@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
    <h2 class="text-left text-xl font-semibold mb-2 mt-5">Edit Penempatan Barang</h2>
    <hr class="mb-4">

    <form action="{{ route('penempatan.update', $penempatan->kd_penempatan) }}" method="POST" class="max-w-lg mx-auto p-4">
        @csrf
        @method('PUT')
        <!-- No. Penempatan (Readonly) -->
        <div class="mb-4">
            <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penempatan</label>
            <input type="text" id="kd_penempatan" name="kd_penempatan" value="{{ $penempatan->kd_penempatan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Kode Barang -->
        <div class="mb-4">
            <label for="kd_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
            <select id="kd_barang" name="kd_barang"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                <option value="">-- Pilih Kode Barang --</option>
                @foreach ($barang as $brg)
                    <option value="{{ $brg->kd_barang }}" {{ $brg->kd_barang == $penempatan->kd_barang ? 'selected' : '' }}>
                        {{ $brg->kd_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Nama Barang -->
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <select id="nama_barang" name="nama_barang"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                <option value="">-- Pilih Nama Barang --</option>
                @foreach ($barang as $brg)
                    <option value="{{ $brg->nama_barang }}" {{ $brg->nama_barang == $penempatan->nama_barang ? 'selected' : '' }}>
                        {{ $brg->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Penempatan -->
        <div class="mb-4">
            <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penempatan</label>
            <input type="date" id="tgl_penempatan" name="tgl_penempatan" value="{{ $penempatan->tgl_penempatan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <!-- Keterangan -->
        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" value="{{ $penempatan->keterangan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
@endsection
