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
            background-color: rgba(0,0,0,0.4); 
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
<body class="bg-gray-200 text-black font-sans">
    <main class="container mx-auto py-10">
        <h1 class="text-black text-3xl sm:text-4xl mt-24 pl-6 font-medium">Daftar Kelola Jadwal</h1>
        <div class="flex flex-col md:flex-row justify-center mt-10">
            <!-- Calendar Section -->
            <div class="w-full md:w-1/2 mr-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Jadwal Maintenance</h2>
                    <div class="flex justify-between items-center mb-4">
                        <!-- Button for navigating months -->
                        <form method="GET" action="{{ route('jadwal') }}">
                            <input type="hidden" name="month" value="{{ \Carbon\Carbon::parse($currentMonthYear)->subMonth()->format('Y-m') }}">
                            <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                        </form>
                        <span id="currentMonth" class="text-gray-700 font-bold">{{ \Carbon\Carbon::parse($currentMonthYear)->format('F Y') }}</span>
                        <form method="GET" action="{{ route('jadwal') }}">
                            <input type="hidden" name="month" value="{{ \Carbon\Carbon::parse($currentMonthYear)->addMonth()->format('Y-m') }}">
                            <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <!-- Calendar Table -->
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
                                            {{ $jadwals->contains('tanggal', $currentDay->toDateString()) ? 'bg-blue-100' : '' }}" 
                                            data-date="{{ $currentDay->toDateString() }}">
                                            @if ($currentDay->month == $date->month)
                                                {{ $currentDay->day }}
                                                @foreach ($jadwals as $jadwal)
                                                    @if ($jadwal->tanggal == $currentDay->toDateString())
                                                        <p class="text-sm text-blue-500">{{ $jadwal->kegiatan }}</p>
                                                        <p class="text-xs text-gray-600">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_berakhir }}</p>
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

            <!-- Form Section -->
            <div class="w-full md:w-1/2">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Tambahkan Jadwal</h2>
                    <!-- Form for Adding Schedule -->
                    <form id="jadwalForm" action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="jam_mulai" class="block text-gray-700 font-bold mb-2">Jam Mulai</label>
                            <input type="time" id="jam_mulai" name="jam_mulai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="jam_berakhir" class="block text-gray-700 font-bold mb-2">Jam Berakhir</label>
                            <input type="time" id="jam_berakhir" name="jam_berakhir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="kegiatan" class="block text-gray-700 font-bold mb-2">Kegiatan Maintenance</label>
                            <input type="text" id="kegiatan" name="kegiatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi Maintenance</label>
                            <textarea id="deskripsi" name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="foto" class="block text-gray-700 font-bold mb-2">Foto Dokumentasi</label>
                            <input type="file" id="foto" name="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <!-- Trigger modal -->
                            <button type="button" onclick="showModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Tambahkan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Confirmation -->
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <h2 class="text-lg font-bold mb-4">Konfirmasi</h2>
                <p>Apakah data yang Anda masukkan sudah benar?</p>
                <div class="flex justify-end mt-4">
                    <button onclick="hideModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</button>
                    <button onclick="submitForm()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ya, Submit</button>
                </div>
            </div>
        </div>

    </main>
    <script>
        // Function to show the modal
        function showModal() {
            document.getElementById('confirmationModal').style.display = 'flex';
        }

        // Function to hide the modal
        function hideModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        // Function to submit the form
        function submitForm() {
            document.getElementById('jadwalForm').submit();
        }
    </script>
</body>
</html>
@endsection
