@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4 ">
        <h2 class="text-left text-xl font-semibold">Judul Konten</h2>
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('tambah-pengadaan') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah</a>
        </div>
    </div>
    <hr class="mb-6">
    <div class="content">
        <!-- Konten akan ditambahkan di sini -->
    </div>
</div>
@endsection
