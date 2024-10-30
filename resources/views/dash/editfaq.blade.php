@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-[30px] mt-[-10px]">
        <h1 class="text-xl font-bold mb-4">Edit FAQ</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">

            <form action="{{ route('faq.update', $faq->kd_faq) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kategori Layanan -->
                <div class="mb-4 relative">
                    <label class="block text-sm font-bold mb-2" for="kd_layanan">Bidang Permasalahan</label>
                    <select id="kd_layanan" name="kd_layanan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        @foreach ($layananOptions as $layanan)
                            <option value="{{ $layanan->kd_layanan }}"
                                {{ $faq->kd_layanan == $layanan->kd_layanan ? 'selected' : '' }}>
                                {{ $layanan->nama_layanan }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10l5 5 5-5H7z" />
                        </svg>
                    </div>
                </div>

                <!-- Nama Masalah -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="pertanyaan">Nama Masalah</label>
                    <input type="text" id="pertanyaan" name="pertanyaan" value="{{ $faq->pertanyaan }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>

                <!-- Deskripsi Penyelesaian Masalah -->
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="penyelesaian">Deskripsi Penyelesaian Masalah</label>
                    <textarea id="penyelesaian" name="penyelesaian"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" rows="10" required>{{ $faq->penyelesaian }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-gray-800 rounded-full border border-gray-200 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Submit
                </button>
            </form>
        </div>
    </div>
@endsection
