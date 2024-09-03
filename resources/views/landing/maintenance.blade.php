@extends('layouts.homelayout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
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
                        <input type="hidden" name="month" value="{{ \Carbon\Carbon::parse($currentMonthYear)->subMonth()->format('Y-m') }}">
                        <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    </form>
                    <span id="currentMonth" class="text-gray-700 font-bold">{{ \Carbon\Carbon::parse($currentMonthYear)->format('F Y') }}</span>
                    <form method="GET" action="{{ route('maintenance') }}">
                        <input type="hidden" name="month" value="{{ \Carbon\Carbon::parse($currentMonthYear)->addMonth()->format('Y-m') }}">
                        <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
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

        <!-- Maintenance Details Section -->
        <div id="maintenanceDetails" class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Detail Maintenance</h2>
            <div id="detailsContent">
                <p class="text-gray-700">Klik pada tanggal yang memiliki jadwal untuk melihat detail.</p>
            </div>
        </div>
    </div>
</main>

<script>
    function showMaintenanceDetails(date) {
        const jadwals = @json($jadwals);

        const detailsDiv = document.getElementById('detailsContent');
        const maintenanceForDate = jadwals.filter(jadwal => jadwal.tanggal === date);

        if (maintenanceForDate.length > 0) {
            let detailsHTML = '<ul>';
            maintenanceForDate.forEach(jadwal => {
                detailsHTML += `
                    <li class="mb-4 border-b pb-2">
                        <p class="text-lg font-bold text-blue-500">${jadwal.kegiatan}</p>
                        <p class="text-sm text-gray-600"><strong>Tanggal:</strong> ${jadwal.tanggal}</p>
                        <p class="text-sm text-gray-600"><strong>Waktu:</strong> ${jadwal.jam_mulai} - ${jadwal.jam_berakhir}</p>
                        <p class="text-sm text-gray-600"><strong>Deskripsi Maintenance:</strong> ${jadwal.deskripsi}</p>
                        ${jadwal.foto ? `<div class="mt-2"><img src="{{ asset('storage/fotos/${jadwal.foto}') }}" alt="Foto Maintenance" class="w-full h-auto rounded-lg shadow-md"></div>` : ''}
                    </li>
                `;
            });
            detailsHTML += '</ul>';
            detailsDiv.innerHTML = detailsHTML;
        } else {
            detailsDiv.innerHTML = '<p class="text-gray-700">Tidak ada jadwal maintenance pada tanggal ini.</p>';
        }
    }
</script>


</body>
</html>
@endsection