@extends('layouts.homelayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maintenance</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- FullCalendar CSS -->
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />

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
            <h1 class="text-black text-3xl sm:text-4xl mt-24 pl-6 font-medium" id="list-tabel">List Tabel Maintenance</h1>

            <!-- Tabel Jadwal -->
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam
                                Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam
                                Berakhir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jadwalsPaginated as $jadwal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $jadwal->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $jadwal->kegiatan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $jadwal->jam_mulai }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $jadwal->jam_berakhir }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $jadwal->deskripsi }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $jadwalsPaginated->withQueryString()->links() }}
                </div>
            </div>

            <h1 class="text-black text-3xl sm:text-4xl mt-24 pl-6 font-medium" id="jadwal-maintenance">Jadwal Maintenance
            </h1>
            <!-- Kalender Maintenance -->
            <div class="flex flex-col md:flex-row justify-center mt-10">
                <!-- Calendar Section -->
                <div class="w-full md:w-1/2 mr-4">
                    <div id='calendar' class="bg-white p-6 rounded-lg shadow-md"></div>
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

        <!-- FullCalendar JavaScript -->
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jadwals = @json($jadwals);
                const calendarEl = document.getElementById('calendar');

                // Fungsi untuk menentukan warna berdasarkan kategori
                function getCategoryColor(kategori) {
                    switch (kategori) {
                        case 'Aplikasi & Website':
                            return '#FF9800'; // Oranye
                        case 'Internet & Jaringan':
                            return '#2196F3'; // Biru
                        case 'Wallmount':
                            return '#4f8f4d'; // Hijau
                        default:
                            return '#9E9E9E'; // Abu-abu untuk kategori lain
                    }
                }

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: jadwals.map(jadwal => ({
                        title: jadwal.kategori,
                        start: jadwal.tanggal,
                        backgroundColor: getCategoryColor(jadwal.kategori),
                        borderColor: getCategoryColor(jadwal.kategori),
                        textColor: '#ffffff',
                        extendedProps: {
                            id: jadwal.id,
                            kegiatan: jadwal.kegiatan,
                            jam_mulai: jadwal.jam_mulai,
                            jam_berakhir: jadwal.jam_berakhir,
                            deskripsi: jadwal.deskripsi,
                            foto: jadwal.foto,
                            foto_kedua: jadwal
                                .foto_kedua // Pastikan ini sesuai dengan field di database
                        }
                    })),

                        dateClick: function(info) {
                            showMaintenanceDetails(info.dateStr);
                        },
                        eventClick: function(info) {
                            showMaintenanceDetails(info.event.startStr);
                        },

                });

                calendar.render();
            });

            function showMaintenanceDetails(date) {
                const jadwals = @json($jadwals);
                const storageUrl = "{{ asset('storage/fotos') }}";
                const detailsDiv = document.getElementById('maintenanceDetails');
                const maintenanceForDate = jadwals.filter(jadwal => jadwal.tanggal === date);

                if (maintenanceForDate.length > 0) {
                    let detailsHTML = '<ul>';
                    maintenanceForDate.forEach(jadwal => {
                        let fotoHTML = '';
                        let fotoKeduaHTML = '';

                        // Handling multiple photos for 'before maintenance'
                        if (jadwal.foto) {
                            const fotos = jadwal.foto.split(',');
                            fotoHTML = `
                        <div class="relative">
                            <div class="flex overflow-hidden" id="carousel-${jadwal.id}">
                                ${fotos.map((foto, index) => `
                                            <div class="carousel-item w-full flex-shrink-0 transition-transform duration-500 ${index === 0 ? 'block' : 'hidden'}">
                                                <img src="${storageUrl}/${foto.trim()}" alt="Foto Sebelum Maintenance" class="w-full h-full object-contain max-h-64 rounded-lg">
                                            </div>
                                        `).join('')}
                            </div>
                            <button class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow" onclick="moveSlide(${jadwal.id}, -1)">&#10094;</button>
                            <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow" onclick="moveSlide(${jadwal.id}, 1)">&#10095;</button>
                        </div>
                    `;
                        }

                        // Check for second image (after maintenance)
                        if (jadwal.foto_kedua) {
                            const fotoKeduas = jadwal.foto_kedua.split(',');
                            fotoKeduaHTML = `
                        <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sesudah Maintenance</label>
                        <div class="relative">
                            <div class="flex overflow-hidden" id="carousel-second-${jadwal.id}">
                                ${fotoKeduas.map((foto, index) => `
                                            <div class="carousel-item w-full flex-shrink-0 transition-transform duration-500 ${index === 0 ? 'block' : 'hidden'}">
                                                <img src="${storageUrl}/${foto.trim()}" alt="Foto Setelah Maintenance" class="w-full h-full object-contain max-h-64 rounded-lg">
                                            </div>
                                        `).join('')}
                            </div>
                            <button class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow" onclick="moveSlideSecond(${jadwal.id}, -1)">&#10094;</button>
                            <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow" onclick="moveSlideSecond(${jadwal.id}, 1)">&#10095;</button>
                        </div>
                    `;
                        } else {
                            // If second image is not available, show the upload form
                            fotoKeduaHTML = `
                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Peringatan!</span> Gambar Sebelum Maintenance Belum Tersedia
                            </div>
                            </div>`;
                        }

                        detailsHTML += `
                    <li class="mb-4 border-b pb-2">
                        <h2 class="text-xl font-bold mb-4">Detail Maintenance</h2>
                        <hr class="w-47 h-1 my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
                        <div class="my-4">
                            <label for="waktu_maintenance" class="text-lg font-bold text-gray-800">Waktu Maintenance</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="tanggal" name="tanggal" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.tanggal}" readonly>
                                <input type="text" id="jam_mulai" name="jam_mulai" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value=" Jam ${jadwal.jam_mulai}" readonly>
                                <span class="text-center mx-1">-</span>
                                <input type="text" id="jam_berakhir" name="jam_berakhir" class="text-center shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.jam_berakhir}" readonly>
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="deskripsi" class="text-lg font-bold text-gray-800">Deskripsi Maintenance</label>
                            <textarea id="deskripsi" name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" readonly>${jadwal.deskripsi}</textarea>
                        </div>
                        ${jadwal.wallmount ? `
                                    <div class="my-4">
                                        <label for="wallmount" class="text-lg font-bold text-gray-800">Wallmount</label>
                                        <input type="text" id="wallmount" name="wallmount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.wallmount.nama}" readonly>
                                    </div>` : ''}
                        <div class="my-4">
                            <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sebelum Maintenance</label>
                            ${fotoHTML} <!-- Display all before-maintenance photos -->
                        </div>
                        <div class="my-4">
                            ${fotoKeduaHTML} <!-- Display second image or upload form -->
                        </div>
                    </li>`;
                    });

                    detailsHTML += '</ul>';
                    detailsDiv.innerHTML = detailsHTML;
                } else {
                    detailsDiv.innerHTML = '<p>No maintenance found for this date.</p>';
                }
            }

            function moveSlide(jadwalId, direction) {
                const carousel = document.getElementById(`carousel-${jadwalId}`);
                const items = carousel.getElementsByClassName('carousel-item');
                let currentIndex = Array.from(items).findIndex(item => !item.classList.contains('hidden'));

                // Update current index based on direction
                currentIndex += direction;
                if (currentIndex < 0) {
                    currentIndex = items.length - 1; // Loop back to the last item
                } else if (currentIndex >= items.length) {
                    currentIndex = 0; // Loop back to the first item
                }

                // Show the current item and hide others
                Array.from(items).forEach((item, index) => {
                    item.classList.toggle('hidden', index !== currentIndex);
                });
            }

            function moveSlideSecond(jadwalId, direction) {
                const carousel = document.getElementById(`carousel-second-${jadwalId}`);
                const items = carousel.getElementsByClassName('carousel-item');
                let currentIndex = Array.from(items).findIndex(item => !item.classList.contains('hidden'));

                // Update current index based on direction
                currentIndex += direction;
                if (currentIndex < 0) {
                    currentIndex = items.length - 1; // Loop back to the last item
                } else if (currentIndex >= items.length) {
                    currentIndex = 0; // Loop back to the first item
                }

                // Show the current item and hide others
                Array.from(items).forEach((item, index) => {
                    item.classList.toggle('hidden', index !== currentIndex);
                });
            }
        </script>
    </body>

    </html>
@endsection
