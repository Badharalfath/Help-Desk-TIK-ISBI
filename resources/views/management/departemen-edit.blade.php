@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-2xl font-bold mb-5">Edit Departemen</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('departemen.update', $departemen->kode) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_departemen" class="block text-gray-700">Nama Departemen</label>
                <input type="text" name="nama_departemen" value="{{ $departemen->nama_departemen }}" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700">Keterangan</label>
                <textarea name="keterangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ $departemen->keterangan }}</textarea>
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan Perubahan</button>
        </form>
    </div>
@endsection
