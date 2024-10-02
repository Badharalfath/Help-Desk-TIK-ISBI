@extends('layouts.homedash')

@section('content')
<div class="container mx-auto p-8">

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="text-2xl font-bold mb-4">Tambah Kategori</h2>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="kode" class="block text-gray-700">Kode</label>
            <input type="text" id="kd_kategori" name="kd_kategori" value="{{ $kodeOtomatis }}" class="border p-2 w-full" readonly>

        </div>
        <div class="mb-4">
            <label for="nama_kategori" class="block text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
    </form>
</div>
@endsection