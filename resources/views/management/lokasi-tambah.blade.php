@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Tambah Lokasi</h2>
        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="kode" class="block text-gray-700">Kode</label>
                <input type="text" id="kode" name="kode" value="{{ $kodeOtomatis }}" class="border p-2 w-full" readonly>
            </div>
            <div class="mb-4">
                <label for="nama_lokasi" class="block text-gray-700">Nama Lokasi</label>
                <input type="text" id="nama_lokasi" name="nama_lokasi" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="kode_departemen" class="block text-gray-700">Departemen</label>
                <select id="kode_departemen" name="kode_departemen" class="border p-2 w-full" required>
                    @foreach ($departemen as $d)
                        <option value="{{ $d->kode }}">{{ $d->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
