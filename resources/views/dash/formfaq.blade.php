@extends('layouts.homedash')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-800 p-6">
            <h3 class="text-white text-lg font-semibold">Form FAQ</h3>
        </div>
        <div class="p-6">


            <form action="{{ route('formfaq.store') }}" method="POST">
                @csrf
                <!-- Bidang Permasalahan -->
                <div class="mb-4">
                    <label for="bidang_permasalahan" class="block text-gray-700 font-bold mb-2">Bidang Permasalahan</label>
                    <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="bidang_permasalahan" name="bidang_permasalahan" required>
                </div>



                <div class="mb-4">
                    <label for="nama_masalah" class="block text-gray-700 font-bold mb-2">Nama Masalah</label>
                    <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="nama_masalah" name="nama_masalah" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_penyelesaian_masalah" class="block text-gray-700 font-bold mb-2">Deskripsi
                        Penyelesaian Masalah</label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="deskripsi_penyelesaian_masalah" name="deskripsi_penyelesaian_masalah" rows="4"
                        required></textarea>
                </div>
                <button type="submit"
                    class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-gray-800 rounded-full border border-gray-200 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
