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
                    @foreach($jadwals as $jadwal)
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
        document.addEventListener('DOMContentLoaded', function () {
            const jadwals = @json($jadwals);
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: jadwals.map(jadwal => ({
                    title: jadwal.kegiatan,
                    start: jadwal.tanggal,
                    extendedProps: {
                        id: jadwal.id,
                        kegiatan: jadwal.kegiatan,
                        jam_mulai: jadwal.jam_mulai,
                        jam_berakhir: jadwal.jam_berakhir,
                        deskripsi: jadwal.deskripsi,
                        foto: jadwal.foto,
                        foto_sesudah: jadwal.foto_sesudah
                    }
                })),
                dateClick: function (info) {
                    showMaintenanceDetails(info.dateStr);
                },
                eventClick: function (info) {
                    showMaintenanceDetails(info.event.startStr);
                }
            });

            calendar.render();
        });

        function showMaintenanceDetails(date) {
            const jadwals = @json($jadwals);
            const storageUrl = "{{ asset('storage/fotos') }}";
            const detailsDiv = document.getElementById('detailsContent');
            const maintenanceForDate = jadwals.filter(jadwal => jadwal.tanggal === date);

            if (maintenanceForDate.length > 0) {
                let detailsHTML = '<ul>';
                maintenanceForDate.forEach(jadwal => {

                    // Mengolah foto sebelum maintenance jika lebih dari satu
                    let fotoHTML = '';
                    if (jadwal.foto) {
                        const fotos = jadwal.foto.split(','); // Pisahkan string foto yang dipisahkan koma
                        fotoHTML = fotos.map(foto => `
                        <div class="mt-2 p-2 border rounded-lg shadow-md bg-white">
                            <img src="${storageUrl}/${foto.trim()}" alt="Foto Sebelum Maintenance" class="w-full h-auto max-w-md mx-auto">
                        </div>
                    `).join(''); // Gabungkan semua foto menjadi satu HTML string
                    }

                    // Mengolah foto sesudah maintenance jika lebih dari satu
                    let fotoSesudahHTML = '';
                    if (jadwal.foto_kedua) {
                        const fotos = jadwal.foto_kedua.split(','); // Pisahkan string foto yang dipisahkan koma
                        fotoSesudahHTML = fotos.map(foto_kedua => `
                        <div class="mt-2 p-2 border rounded-lg shadow-md bg-white">
                            <img src="${storageUrl}/${foto_kedua.trim()}" alt="Foto Sebelum Maintenance" class="w-full h-auto max-w-md mx-auto">
                        </div>
                    `).join(''); // Gabungkan semua foto menjadi satu HTML string
                    }

                    detailsHTML += `
                            <li class="mb-4 border-b pb-2">
                                <hr class="w-47 h-1 my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">

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

                                <!-- Dokumentasi Sebelum Maintenance -->
                                <div class="my-4">
                                    <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sebelum Maintenance</label>
                                    ${fotoHTML} <!-- Menampilkan semua foto -->
                                </div>

                                <!-- Dokumentasi Sesudah -->
                                <div class="my-4">
                                    <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sebelum Maintenance</label>
                                    ${fotoSesudahHTML} <!-- Menampilkan semua foto -->
                                </div>

                                <!-- Generate Report Button -->
                                <div class="my-4">
                                    <form method="POST" action="{{ route('maintenance.generateReport') }}">
                                        @csrf
                                        <input type="hidden" name="jadwal_id" value="${jadwal.id}">
                                        <button type="submit" class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            Generate Report
                                        </button>
                                    </form>
                                </div>
                            </li>
                        `;
                });
                detailsHTML += '</ul>';
                detailsDiv.innerHTML = detailsHTML;
            } else {
                detailsDiv.innerHTML = '<p class="text-gray-700">Tidak ada jadwal maintenance pada tanggal ini.</p>';
            }
        }

        // Scroll untuk List Tabel Maintenance
        document.getElementById('scroll-list').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah default behavior

            if (window.location.pathname.includes('/maintenance')) {
                var targetElement = document.getElementById('list-tabel');
                var offset = 150; // Sesuaikan dengan kebutuhan offset

                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            } else {
                window.location.href = "{{ route('maintenance') }}#list-tabel";
            }
        });

        // Scroll untuk Jadwal Maintenance
        document.getElementById('scroll-jadwal').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah default behavior

            if (window.location.pathname.includes('/maintenance')) {
                var targetElement = document.getElementById('jadwal-maintenance');
                var offset = 150; // Sesuaikan dengan kebutuhan offset

                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            } else {
                window.location.href = "{{ route('maintenance') }}#jadwal-maintenance";
            }
        });
    </script>
</body>

</html>
@endsection