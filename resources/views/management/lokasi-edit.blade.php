@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 py-6 px-10 rounded-lg shadow-md mt-10 mx-10">
        <h2 class="text-2xl font-bold mb-4">Edit Lokasi</h2>
        <form action="{{ route('lokasi.update', $lokasi->kd_lokasi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="kd_lokasi" class="block text-gray-700">Kode Lokasi</label>
                <input type="text" id="kd_lokasi" name="kd_lokasi" value="{{ $lokasi->kd_lokasi }}" class="border p-2 w-full" readonly>
            </div>
            <div class="mb-4">
                <label for="nama_lokasi" class="block text-gray-700">Nama Lokasi</label>
                <input type="text" id="nama_lokasi" name="nama_lokasi" value="{{ $lokasi->nama_lokasi }}" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="kd_departemen" class="block text-gray-700">Departemen</label>
                <select id="kd_departemen" name="kd_departemen" class="border p-2 w-full" required>
                    @foreach ($departemen as $d)
                        <option value="{{ $d->kd_departemen }}" {{ $lokasi->kd_departemen == $d->kd_departemen ? 'selected' : '' }}>
                            {{ $d->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
