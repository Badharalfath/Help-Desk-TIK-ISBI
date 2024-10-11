@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Lokasi</h2>
        <hr class="mb-4">

        <form action="{{ route('lokasi.store') }}" method="POST" class="max-w-lg mx-auto p-4">
            @csrf

            <!-- Kode Lokasi (Otomatis) -->
            <div class="mb-4">
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode Lokasi</label>
                <input type="text" id="kode" name="kode" value="{{ $kodeOtomatis }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
            </div>

            <!-- Nama Lokasi -->
            <div class="mb-4">
                <label for="nama_lokasi" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                <input type="text" id="nama_lokasi" name="nama_lokasi"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <!-- Departemen -->
            <div class="mb-4">
                <label for="kode_departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                <select id="kode_departemen" name="kode_departemen"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    <option value="">-- Pilih Departemen --</option>
                    @foreach ($departemen as $dept)
                        <option value="{{ $dept->kode }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
@endsection
