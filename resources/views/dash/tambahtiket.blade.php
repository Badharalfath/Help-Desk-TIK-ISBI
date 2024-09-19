@extends('layouts.homedash')

@section('content')
<!-- resources/views/complaint.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[url('https://dummyimage.com/1920x1080/000/fff')]">


    <main class="container mx-auto py-4">
        <div class="flex flex-col md:flex-row justify-center mt-14 mb-[50px]">
            <div class="w-full md:w-1/2">
                <div class="bg-white p-6 rounded shadow-md">

                    <h2 class="text-xl font-bold mb-4">Form Laporan</h2>

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    

                    <form method="POST" action="{{ route('submit.tambahtiket') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" name="email" id="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                            <input type="text" name="name" id="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Laporan</label>
                            <input type="text" name="judul" id="judul"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Dropdown Kategori Laporan -->
                        <div class="mb-4">
                            <label for="kategori" class="block text-gray-700 font-bold mb-2">Kategori Laporan</label>
                            <select name="kategori" id="kategori"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Aplikasi">Aplikasi</option>
                                <option value="Email/Website">Email/Website</option>
                                <option value="Jaringan">Jaringan/Internet</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="keluhan" class="block text-gray-700 font-bold mb-2">Laporan Keluhan</label>
                            <textarea name="keluhan" id="keluhan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <!-- Input for Foto Laporan -->
                        <div class="mb-4">
                            <label for="foto" class="block text-gray-700 font-bold mb-2">Foto Laporan</label>
                            <input type="file" name="foto[]" id="foto" multiple
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- Input for Lokasi (disembunyikan jika kategori bukan Jaringan) -->
                        <div id="lokasi_field" class="mb-4 hidden">
                            <label for="lokasi" class="block text-gray-700 font-bold mb-2">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan lokasi laporan">
                        </div>

                        <div class="flex mb-4 justify-center">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        </div>
                        <button type="submit"
                            class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var kategoriDropdown = document.getElementById('kategori');
            var lokasiField = document.getElementById('lokasi_field');

            kategoriDropdown.addEventListener('change', function () {
                if (this.value === 'Jaringan') {
                    lokasiField.classList.remove('hidden');
                } else {
                    lokasiField.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>
@endsection
