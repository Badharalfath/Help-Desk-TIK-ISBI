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
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold mb-5">Daftar Pengguna</h2>

            <!-- Button tambah user -->

            <div class=" flex justify-end mb-4">
                <a href="{{ route('listjadwal') }}"
                    class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Kembali
                </a>
                <a href="{{ route('jadwal') }}"
                    class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Input Pengguna
                </a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-center mt-10">

            <!-- Calendar Section -->
            <div class="w-full md:w-1/2 mr-4">
                <div id='calendar' class="bg-white p-6 rounded-lg shadow-md"></div>
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
                @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                <h2 class="text-xl font-bold mb-4">Tambahkan Jadwal Maintenance</h2>
                <hr class="w-47 h-1 my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
                <form id="jadwalForm" action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>

                    <div class="mb-4">
                        <label for="jam_mulai" class="block text-gray-700 font-bold mb-2">Jam Mulai</label>
                        <input type="time" id="jam_mulai" name="jam_mulai"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>

                    <div class="mb-4">
                        <label for="jam_berakhir" class="block text-gray-700 font-bold mb-2">Jam Berakhir</label>
                        <input type="time" id="jam_berakhir" name="jam_berakhir"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            onchange="showWallmountOptions(this)" required>
                            <option value="" disabled selected>-</option>
                            <option value="Website">Website</option>
                            <option value="Aplikasi & Website">Aplikasi & Website</option>
                            <option value="Internet & Jaringan">Internet & Jaringan</option>
                            <option value="Wallmount">Wallmount</option>
                        </select>
                    </div>

                    <!-- Section that will display when Wallmount is selected -->
                    <div id="wallmount-section" class="mb-4 hidden">
                        <label for="wallmount_id" class="block text-gray-700 font-bold mb-2">Pilih Wallmount</label>
                        <select id="wallmount_id" name="wallmount_id" onchange="fetchPerangkat(this.value)"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Pilih Wallmount</option>
                            @foreach ($wallmounts as $wallmount)
                                <option value="{{ $wallmount->id }}">{{ $wallmount->nama }} (lokasi :
                                    {{ $wallmount->lokasi }})
                                </option>
                            @endforeach
                        </select>
                        <div>
                            <label for="perangkat" class="block text-gray-700 font-bold mb-2 mt-4">Pilih
                                Perangkat:</label>
                            <select name="perangkat_id" id="perangkat"
                                class="form-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih perangkat</option>
                            </select>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="kegiatan" class="block text-gray-700 font-bold mb-2">Kegiatan Maintenance</label>
                        <input type="text" id="kegiatan" name="kegiatan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>

                    <div class="mb-4">
                        <label for="pic" class="block text-gray-700 font-bold mb-2">Person In
                            Charge</label>
                        <input type="text" id="pic" name="pic"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>


                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi
                            Maintenance</label>
                        <textarea id="deskripsi" name="deskripsi"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700 font-bold mb-2">Input Foto Sebelum
                            Maintenance</label>
                        <input type="file" id="foto" name="foto[]" multiple
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            {{ $isInput ? 'required' : 'disabled' }}>
                    </div>

                    @if ($isInput)
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tambahkan
                                Jadwal</button>
                        </div>
                    @endif
                </form>
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
                @if ($isInput)
                        dateClick: function (info) {
                        showMaintenanceDetails(info.dateStr);
                    },
                    eventClick: function (info) {
                        showMaintenanceDetails(info.event.startStr);
                    },
                @endif
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
                    // Process photos if there are multiple
                    let fotoHTML = '';
                    if (jadwal.foto) {
                        const fotos = jadwal.foto.split(','); // Split photo string by comma
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
                    detailsHTML += `
            <li class="mb-4 border-b pb-2">
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
                
                ${jadwal.wallmount ? `
                    <!-- Nama Wallmount -->
                    <div class="my-4">
                        <label for="wallmount" class="text-lg font-bold text-gray-800">Wallmount</label>
                        <input type="text" id="wallmount" name="wallmount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.wallmount.nama}" readonly>
                    </div>
                ` : ''}

                ${jadwal.perangkat ? `
                    <!-- Nama Perangkat -->
                    <div class="my-4">
                        <label for="perangkat" class="text-lg font-bold text-gray-800">Perangkat</label>
                        <input type="text" id="perangkat" name="perangkat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.perangkat.nama_perangkat}" readonly>
                    </div>
                ` : ''}

                <!-- Dokumentasi Sebelum Maintenance -->
                <div class="my-4">
                    <label for="dokumentasi" class="text-lg font-bold text-gray-800">Sebelum Maintenance</label>
                    ${fotoHTML} <!-- Display all photos -->
                </div>

                <!-- Input gambar kedua jika belum ada -->
                ${jadwal.foto_kedua ? `
                    <div class="my-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                        Foto kedua sudah ada dan tidak dapat diunggah lagi.
                    </div>` : `
                    <form id="fotoKeduaForm" action="/jadwal/${jadwal.id}/update-foto-kedua" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="foto_kedua" class="block text-gray-700 font-bold mb-2">Input Foto Setelah Maintenance</label>
                            <input type="file" id="foto_kedua" name="foto_kedua[]" multiple
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit" class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Submit
                        </button>
                    </form>`}
            </li>`;
                });
                detailsHTML += '</ul>';
                detailsDiv.innerHTML = detailsHTML;
            } else {
                detailsDiv.innerHTML = document.getElementById('jadwalForm').outerHTML;
                document.getElementById('tanggal').value = date;
            }
        }



        function showWallmountOptions(selectElement) {
            var selectedCategory = selectElement.value;
            var wallmountSection = document.getElementById('wallmount-section');

            if (selectedCategory === 'Wallmount') {
                wallmountSection.classList.remove('hidden');
            } else {
                wallmountSection.classList.add('hidden');
            }
        }

        function fetchPerangkat(wallmountId) {
            console.log('Fetching perangkat for wallmount ID:', wallmountId); // Debugging: cek ID yang dikirim

            if (wallmountId) {
                // Lakukan AJAX request untuk mengambil perangkat berdasarkan wallmount
                fetch(`/perangkat-by-wallmount/${wallmountId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data perangkat:', data); // Debugging: cek data perangkat yang diterima

                        // Kosongkan select perangkat
                        const perangkatSelect = document.getElementById('perangkat');
                        perangkatSelect.innerHTML = '<option value="">Pilih perangkat</option>';

                        // Tambahkan option perangkat jika ada perangkat yang ditemukan
                        if (data.length > 0) {
                            data.forEach(perangkat => {
                                perangkatSelect.innerHTML += `
                            <option value="${perangkat.id}">${perangkat.nama_perangkat}</option>
                        `;
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error); // Debugging: tampilkan error jika ada
                    });
            } else {
                // Kosongkan select perangkat jika tidak ada wallmount yang dipilih
                document.getElementById('perangkat').innerHTML = '<option value="">Pilih perangkat</option>';
            }
        }


        let currentSlides = {};

        function moveSlide(jadwalId, direction) {
            const slides = document.querySelectorAll(`#carousel-${jadwalId} .carousel-item`);
            const totalSlides = slides.length;

            // Initialize current slide if not already
            if (!currentSlides[jadwalId]) {
                currentSlides[jadwalId] = 0;
            }

            // Update current slide index
            currentSlides[jadwalId] = (currentSlides[jadwalId] + direction + totalSlides) % totalSlides;

            // Hide all slides and show the current one
            slides.forEach((slide, index) => {
                slide.classList.add('hidden');
                if (index === currentSlides[jadwalId]) {
                    slide.classList.remove('hidden');
                }
            });
        }

    </script>
</body>
@endsection