@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-left text-xl font-semibold">Judul Konten</h2>
        <a href="{{ route('penempatan-tambah') }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                Tambah
            </button>
        </a>
    </div>
    <hr class="mb-6">
    <div class="content">
        <!-- Konten akan ditambahkan di sini -->
    </div>
</div>
@endsection
