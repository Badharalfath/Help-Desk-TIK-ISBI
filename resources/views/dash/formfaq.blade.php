@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h2 class="text-left text-xl font-semibold mb-2 mt-5">Input FAQ</h2>
        <hr class="mb-4">

        <!-- Form FAQ -->
        <form action="{{ route('formfaq.store') }}" method="POST" class="max-w-lg mx-auto p-4">
            @csrf

            <!-- Dropdown for Kategori Layanan -->
            <div class="mb-4">
                <label for="kd_layanan" class="block text-sm font-medium text-gray-700">Kategori Layanan</label>
                <select id="kd_layanan" name="kd_layanan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    <option value="">Pilih Kategori Layanan</option>
                    @foreach ($kdLayananOptions as $option)
                        <option value="{{ $option->kd_layanan }}">{{ $option->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pertanyaan -->
            <div class="mb-4">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                <input type="text" id="pertanyaan" name="pertanyaan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <!-- Penyelesaian -->
            <div class="mb-4">
                <label for="penyelesaian" class="block text-sm font-medium text-gray-700">Penyelesaian</label>
                <textarea id="penyelesaian" name="penyelesaian" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Submit</button>
            </div>
        </form>
    </div>
@endsection
