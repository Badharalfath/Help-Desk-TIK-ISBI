@extends('layouts.homedash')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Help Desk Admin</title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            /* Modal styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
            }
        </style>
    </head>

    <body class="bg-[url('https://dummyimage.com/1920x1080/000/fff')] text-black font-sans">
        <main class="container mx-auto py-10">
            <h1 class="text-black text-3xl sm:text-4xl mt-24 pl-6 font-medium"></h1>
            <div class="flex flex-col md:flex-row justify-center mt-10">
                <!-- Calendar Section -->
                <div class="w-full md:w-1/2 mr-4">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-4">Jadwal Maintenance</h2>
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="{{ route('maintenance') }}">
                                <input type="hidden" name="month"
                                    value="{{ \Carbon\Carbon::parse($currentMonthYear)->subMonth()->format('Y-m') }}">
                                <button type="submit"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                            </form>
                            <span id="currentMonth"
                                class="text-gray-700 font-bold">{{ \Carbon\Carbon::parse($currentMonthYear)->format('F Y') }}</span>
                            <form method="GET" action="{{ route('maintenance') }}">
                                <input type="hidden" name="month"
                                    value="{{ \Carbon\Carbon::parse($currentMonthYear)->addMonth()->format('Y-m') }}">
                                <button type="submit"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border text-center">Senin</th>
                                    <th class="py-2 px-4 border text-center">Selasa</th>
                                    <th class="py-2 px-4 border text-center">Rabu</th>
                                    <th class="py-2 px-4 border text-center">Kamis</th>
                                    <th class="py-2 px-4 border text-center">Jumat</th>
                                    <th class="py-2 px-4 border text-center">Sabtu</th>
                                    <th class="py-2 px-4 border text-center">Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $date = \Carbon\Carbon::parse($currentMonthYear . '-01');
                                    $startOfWeek = $date->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                                    $endOfMonth = $date->copy()->endOfMonth();
                                    $currentDay = $startOfWeek->copy();
                                @endphp
                                @while ($currentDay <= $endOfMonth)
                                    <tr>
                                        @for ($i = 0; $i < 7; $i++)
                                            <td class="py-2 px-4 border text-center
                                            {{ $currentDay->month != $date->month ? 'bg-gray-300' : '' }}
                                            {{ $jadwals->contains('tanggal', $currentDay->toDateString()) ? 'bg-blue-100 cursor-pointer' : '' }}"
                                                data-date="{{ $currentDay->toDateString() }}"
                                                onclick="showMaintenanceDetails('{{ $currentDay->toDateString() }}')">
                                                @if ($currentDay->month == $date->month)
                                                    {{ $currentDay->day }}
                                                    @foreach ($jadwals as $jadwal)
                                                        @if ($jadwal->tanggal == $currentDay->toDateString())
                                                            <p class="text-sm text-blue-500">{{ $jadwal->kegiatan }}</p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @php $currentDay->addDay(); @endphp
                                            </td>
                                        @endfor
                                    </tr>
                                @endwhile
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Form Input Section (Default View) -->
                <div id="maintenanceDetails" class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-md">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="this.parentElement.style.display='none';">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    <h2 class="text-xl font-bold mb-4">Tambahkan Jadwal Maintenance</h2>
                    <form id="jadwalForm" action="{{ route('jadwal.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="jam_mulai" class="block text-gray-700 font-bold mb-2">Jam Mulai</label>
                            <input type="time" id="jam_mulai" name="jam_mulai"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="jam_berakhir" class="block text-gray-700 font-bold mb-2">Jam Berakhir</label>
                            <input type="time" id="jam_berakhir" name="jam_berakhir"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="kegiatan" class="block text-gray-700 font-bold mb-2">Kegiatan Maintenance</label>
                            <input type="text" id="kegiatan" name="kegiatan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi
                                Maintenance</label>
                            <textarea id="deskripsi" name="deskripsi"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="block text-gray-700 font-bold mb-2">Input Foto Sebelum
                                Maintenance</label>
                            <input type="file" id="foto" name="foto"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambahkan
                                Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <script>
            function showMaintenanceDetails(date) {
                const jadwals = @json($jadwals);

                const detailsDiv = document.getElementById('maintenanceDetails');
                const maintenanceForDate = jadwals.filter(jadwal => jadwal.tanggal === date);

                if (maintenanceForDate.length > 0) {
                    let detailsHTML = '<ul>';
                    maintenanceForDate.forEach(jadwal => {
                        detailsHTML += `
                        <li class="mb-4 border-b pb-2">
                            <!-- Form untuk mengunggah Foto Kedua -->
                            <form action="/jadwal/${jadwal.id}/update-foto-kedua" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Kegiatan Maintenance -->
                                <div class="my-4">
                                    <label for="kegiatan" class="text-lg font-bold text-gray-800">Kegiatan Maintenance</label>
                                    <input type="text" id="kegiatan" name="kegiatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.kegiatan}" readonly>
                                </div>

                                <!-- Waktu Maintenance -->
                                <div class="my-4">
                                    <label for="waktu_maintenance" class="text-lg font-bold text-gray-800">Waktu Maintenance</label>
                                    <div class="flex items-center gap-2">
                                        <input type="text" id="tanggal" name="tanggal" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.tanggal}" readonly>
                                        <input type="text" id="jam_mulai" name="jam_mulai" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value=" Jam ${jadwal.jam_mulai}" readonly>
                                        <span class="text-center mx-1">-</span>
                                        <input type="text" id="jam_berakhir" name="jam_berakhir" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.jam_berakhir}" readonly>
                                    </div>
                                </div>

                                <!-- Deskripsi Maintenance -->
                                <div class="my-4">
                                    <label for="deskripsi" class="text-lg font-bold text-gray-800">Deskripsi Maintenance</label>
                                    <textarea id="deskripsi" name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" readonly>${jadwal.deskripsi}</textarea>
                                </div>

                                <!-- Dokumentasi -->
                                <div class="my-4">
                                    <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sebelum Maintenance</label>
                                    ${jadwal.foto ? `
                                                                <div class="mt-2 p-2 border rounded-lg shadow-md bg-white">
                                                                    <img src="{{ asset('storage/fotos/${jadwal.foto}') }}" alt="Foto Sebelum Maintenance" class="w-full h-auto max-w-md mx-auto">
                                                                </div>` : ''}
                                </div>
                                <input type="hidden" name="jadwal_id" value="${jadwal.id}">
                                <!-- Input gambar kedua hanya jika belum ada -->
                                ${jadwal.foto_kedua ? `
                                <div class="my-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                                    Foto kedua sudah ada dan tidak dapat diunggah lagi.
                                </div>` : `
                                <div class="mb-4">
                                    <label for="foto_kedua" class="block text-gray-700 font-bold mb-2">Input Foto Setelah Maintenance</label>
                                    <input type="file" name="foto_kedua" id="foto_kedua" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <button type="submit" class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    Submit
                                </button>`}
                            </form>
                        </li>`;
                    });
                    detailsHTML += '</ul>';
                    detailsDiv.innerHTML = detailsHTML;
                } else {
                    detailsDiv.innerHTML = document.getElementById('jadwalForm').outerHTML;
                    document.getElementById('tanggal').value = date;
                }
            }
        </script>
    </body>
@endsection
