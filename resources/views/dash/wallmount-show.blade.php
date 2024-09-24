@extends('layouts.homedash')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Wallmount</h1>

    <form>
        @csrf
        <!-- Nama Wallmount -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium">Nama Wallmount</label>
            <input type="text" name="nama" id="nama" class="border rounded w-full py-2 px-3" value="{{ $wallmount->nama }}" readonly>
        </div>

        <!-- Lokasi -->
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="border rounded w-full py-2 px-3" value="{{ $wallmount->lokasi }}" readonly>
        </div>

        <!-- Perangkat -->
        <div class="mb-4">
            <label for="perangkat" class="block text-sm font-medium">Perangkat</label>
            @foreach ($wallmount->perangkat as $index => $perangkat)
                <input type="text" name="perangkat[]" class="border rounded w-full py-2 px-3 mt-2" value="{{ $perangkat->nama_perangkat }}" readonly>
            @endforeach
        </div>

        <div>
            <a href="{{ route('wallmount.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
