@extends('layouts.homedash')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Departemen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <main class="container mx-auto py-4">
        <div class="flex flex-col md:flex-row justify-center mt-14 mb-[50px]">
            <div class="w-full md:w-1/2">
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4">Tambah Departemen</h2>

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('departemen.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="kode" class="block text-gray-700 font-bold mb-2">Kode Departemen</label>
                            <input type="text" name="kode" id="kode" readonly
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ $kodeOtomatis }}">
                        </div>
                        <div class="mb-4">
                            <label for="nama_departemen" class="block text-gray-700 font-bold mb-2">Nama Departemen</label>
                            <input type="text" name="nama_departemen" id="nama_departemen"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan</label>
                            <textarea name="keterangan" id="keterangan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
@endsection
