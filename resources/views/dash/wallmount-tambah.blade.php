@extends('layouts.homedash')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Wallmount</h1>

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

    <form action="{{ route('wallmount.store') }}" method="POST">
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

        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection