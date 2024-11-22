@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 py-6 px-10 rounded-lg shadow-md mt-10 mx-10">
        <h2 class="text-2xl font-bold mb-5">Edit Departemen</h2>
        <hr class="mb-6 ">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('departemen.update', $departemen->kd_departemen) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="kd_departemen" class="block text-gray-700">Kode Departemen</label>
                <input type="text" name="kd_departemen" value="{{ $departemen->kd_departemen }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" readonly>
            </div>

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
