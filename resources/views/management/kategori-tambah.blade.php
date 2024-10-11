@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
    <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Kategori</h2>
    <hr class="mb-4">

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kategori.store') }}" method="POST" class="max-w-lg mx-auto p-4">
        @csrf
        <div class="mb-4">
            <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
            <input type="text" id="kd_kategori" name="kd_kategori" value="{{ $kodeOtomatis }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>

        </div>
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
    </form>
</div>
@endsection
