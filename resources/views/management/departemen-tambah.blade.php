@extends('layouts.homedash')

@section('content')

<div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
    <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Departemen</h2>
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

    <form method="POST" action="{{ route('departemen.store') }}" class="max-w-lg mx-auto p-4">
        @csrf

        <!-- Kode Departemen (Otomatis) -->
        <div class="mb-4">
            <label for="kode" class="block text-sm font-medium text-gray-700">Kode Departemen</label>
            <input type="text" name="kode" id="kode" value="{{ $kodeOtomatis }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Nama Departemen -->
        <div class="mb-4">
            <label for="nama_departemen" class="block text-sm font-medium text-gray-700">Nama Departemen</label>
            <input type="text" name="nama_departemen" id="nama_departemen"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <!-- Keterangan -->
        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
        </div>

        <!-- Tombol Tambah -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Tambah</button>
        </div>
    </form>
</div>

@endsection
