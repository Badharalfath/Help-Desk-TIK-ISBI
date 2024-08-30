@extends('layouts.homedash')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-sans">

    <!-- Main Content -->
    <div class="container mx-auto mt-12 p-6 ">
        <div class="flex mt-[65px] mb-[50px]">
            <!-- Jadwal Maintenance -->
            <div class="w-1/3">
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Jadwal Maintenance</h2>
                    <!-- Kalender Placeholder -->
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="text-center mb-2">Month year</div>
                        <div class="grid grid-cols-7 gap-2 text-center">
                            <!-- Tampilkan angka 1 di semua kolom sebagai placeholder -->
                            @for ($i = 1; $i <= 35; $i++)
                                <div class="p-2 bg-gray-600 rounded">{{ $i % 7 == 0 ? 1 : '' }}</div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Maintenance -->
            <div class="w-2/3 ml-6">
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Detail Maintenance</h2>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Keterangan</h3>
                        <p class="bg-gray-700 p-4 rounded-lg">Lorem ipsum dolor sit amet consectetur. Ligula arcu leo ut bibendum faucibus tellus.</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Waktu Maintenance</h3>
                        <p class="bg-gray-700 p-4 rounded-lg">Senin 24 Agustus 2024 &nbsp;&nbsp;&nbsp; 15:00 - 18:30</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Dokumentasi</h3>
                        <img src="https://via.placeholder.com/150" alt="Dokumentasi" class="rounded-lg shadow-md">
                    </div>
                    <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600">
                        Generate Report
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

@endsection
