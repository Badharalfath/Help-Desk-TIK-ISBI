@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
    <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Wallmount</h2>
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('wallmount.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium">Nama Wallmount</label>
            <input type="text" name="nama" id="nama" class="border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="border rounded w-full py-2 px-3" required>
        </div>

        <div class="mb-4">
            <label for="perangkat" class="block text-sm font-medium">Perangkat (Maksimal 4)</label>
            @for ($i = 0; $i < 4; $i++)
                <input type="text" name="perangkat[]" class="border rounded w-full py-2 px-3 mt-2">
            @endfor
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium">Foto Wallmount</label>
            <input type="file" name="foto[]" class="border rounded w-full py-2 px-3" multiple>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>
@endsection
