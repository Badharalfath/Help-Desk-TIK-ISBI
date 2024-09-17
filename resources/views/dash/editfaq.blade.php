@extends('layouts.homedash')

@section('content')

<h1 class="text-xl font-bold mb-4">Edit FAQ</h1>

<form action="{{ route('faq.update', $faq->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4 relative">
        <label class="block text-sm font-bold mb-2" for="bidang_permasalahan">Bidang Permasalahan</label>
        <select id="bidang_permasalahan" name="bidang_permasalahan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            <option value="it" {{ $faq->bidang_permasalahan == 'it' ? 'selected' : '' }}>Internet dan Jaringan</option>
            <option value="apps" {{ $faq->bidang_permasalahan == 'apps' ? 'selected' : '' }}>Aplikasi dan Email</option>
        </select>
        <!-- Tanda panah dropdown -->
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M7 10l5 5 5-5H7z" />
            </svg>
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-bold mb-2" for="nama_masalah">Nama Masalah</label>
        <input type="text" id="nama_masalah" name="nama_masalah" value="{{ $faq->nama_masalah }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-bold mb-2" for="deskripsi_penyelesaian_masalah">Deskripsi Penyelesaian Masalah</label>
        <textarea id="deskripsi_penyelesaian_masalah" name="deskripsi_penyelesaian_masalah"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" rows="10">{{ $faq->deskripsi_penyelesaian_masalah }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
        Update FAQ
    </button>
</form>

@endsection
