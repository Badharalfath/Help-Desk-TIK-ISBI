@extends('layouts.homedash')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 p-4">
            <h3 class="text-white text-lg font-semibold">Form FAQ</h3>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('formfaq.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="bidang_permasalahan" class="block text-gray-700 font-bold mb-2">Bidang Permasalahan</label>
                    <div class="relative">
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="bidang_permasalahan" name="bidang_permasalahan" required style="min-width: 250px;">
                            <option value="" disabled selected>-</option>
                            <option value="it">Internet dan Jaringan</option>
                            <option value="apps">Aplikasi dan Email</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                

                <div class="mb-4">
                    <label for="nama_masalah" class="block text-gray-700 font-bold mb-2">Nama Masalah</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_masalah" name="nama_masalah" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_penyelesaian_masalah" class="block text-gray-700 font-bold mb-2">Deskripsi Penyelesaian Masalah</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="deskripsi_penyelesaian_masalah" name="deskripsi_penyelesaian_masalah" rows="4" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
