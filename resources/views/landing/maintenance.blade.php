@extends('layouts.homelayout')

@section('content')
    <style>
        #detailDeskripsi {
            max-height: 150px;
            /* Sesuaikan tinggi maksimal */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            /* Membiarkan teks memanjang ke bawah */
            word-break: break-word;
            /* Memastikan kata terpotong jika terlalu panjang */
        }

        #detailKegiatan {
        word-wrap: break-word;   /* Pastikan kata yang panjang akan dipotong dan pindah ke baris baru */
        white-space: normal;     /* Izinkan teks membungkus */
        overflow: auto;          /* Tambahkan scrollbar jika teks terlalu panjang */
    }
    </style>



    <body class="bg-[url('https://dummyimage.com/1920x1080/000/fff')] text-black font-sans">
        <main class="container mx-auto py-10">
            <h1 class="text-black text-3xl sm:text-4xl mt-24 pl-6 font-medium" id="jadwal-maintenance">Jadwal Maintenance</h1>

            <!-- Kalender Maintenance -->
            <div class="flex flex-col md:flex-row justify-center mt-10">
                <div class="w-full md:w-1/2 mr-4">
                    <div id='calendar' class="bg-white p-6 rounded-lg shadow-md"></div>
                </div>
            </div>
        </main>

        <!-- Modal for Maintenance Details -->
        <div id="maintenanceModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Detail Maintenance</h2>
                    <button onclick="closeMaintenanceModal()" class="text-xl font-bold text-gray-700">&times;</button>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Left column for details -->
                    <div class="w-full md:w-1/2 text-left">
                        <p class="mb-2"><strong>Tanggal:</strong><br> <span id="detailTanggal"></span></p>
                        <p class="mb-2"><strong>Waktu:</strong><br> <span id="detailWaktu"></span></p>
                        <p class="mb-2"><strong>Deskripsi:</strong><br> <span id="detailDeskripsi"></span></p>
                        <p class="mb-2"><strong>Kategori:</strong><br> <span id="detailKategori"></span></p>
                        <p class="mb-2"><strong>Kegiatan:</strong><br>
                            <span id="detailKegiatan"
                                class="overflow-hidden text-ellipsis whitespace-normal max-h-24 block"></span>
                        </p>
                        <p class="mb-2"><strong>Jam Selesai:</strong><br> <span id="detailJamSelesai"></span></p>
                    </div>

                    <!-- Right column for image sliders -->
                    <div class="w-full md:w-1/2 flex flex-col gap-4">
                        <!-- Slider for "Sebelum Maintenance" images -->
                        <div class="relative">
                            <label class="text-lg font-bold text-gray-800 mb-2 block">Sebelum Maintenance</label>
                            <div class="flex overflow-hidden rounded-lg" id="carousel-before">
                                <!-- Images will be dynamically inserted here -->
                            </div>
                            <button
                                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                                onclick="moveSlide('before', -1)">&#10094;</button>
                            <button
                                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                                onclick="moveSlide('before', 1)">&#10095;</button>
                        </div>

                        <!-- Conditionally displayed "Sesudah Maintenance" section -->
                        <div class="relative after-maintenance hidden">
                            <label class="text-lg font-bold text-gray-800 mb-2 block">Sesudah Maintenance</label>
                            <div class="flex overflow-hidden rounded-lg" id="carousel-after">
                                <!-- Images will be dynamically inserted here -->
                            </div>
                            <button
                                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                                onclick="moveSlide('after', -1)">&#10094;</button>
                            <button
                                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                                onclick="moveSlide('after', 1)">&#10094;</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="flex justify-center items-center ">
            <div class="flex space-x-6 mb-4 bg-gray-50 p-2 max-w-[310px] rounded-lg shadow-2xl">
                <!-- Legend Item: Pending -->
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 rounded-full bg-gray-500"></div>
                    <span class="text-gray-700 text-sm">Pending</span>
                </div>
                <!-- Legend Item: On going -->
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 rounded-full bg-orange-500"></div>
                    <span class="text-gray-700 text-sm">On going</span>
                </div>
                <!-- Legend Item: Complete -->
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 rounded-full bg-green-500"></div>
                    <span class="text-gray-700 text-sm">Complete</span>
                </div>
            </div>
        </div>

        <!-- FullCalendar JavaScript -->
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jadwals = @json($jadwals);
                const calendarEl = document.getElementById('calendar');

                // Mapping of category codes to names and colors
                const layananDetails = {
                    "LY001": {
                        name: "Internet & Jaringan",
                        color: "#2196F3"
                    },
                    "LY002": {
                        name: "Aplikasi & Website",
                        color: "#FF9800"
                    },
                    "LY003": {
                        name: "Email",
                        color: "#9E9E9E"
                    },
                    "LY004": {
                        name: "Wallmount",
                        color: "#4f8f4d"
                    }
                };

                // Mapping for progress to colors
                const progressColors = {
                    "PG001": "#6B7280", // Pending - Gray
                    "PG002": "#ed965c", // On going - Orange
                    "PG003": "#67bf79" // Complete - Green
                };

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: jadwals.map(jadwal => {
                        const category = layananDetails[jadwal.kd_layanan] || {};
                        const backgroundColor = progressColors[jadwal.kd_progres] || "#6B7280";

                        return {
                            title: category.name || "Unknown",
                            start: jadwal.tanggal,
                            backgroundColor: backgroundColor,
                            borderColor: backgroundColor,
                            textColor: '#ffffff',
                            extendedProps: {
                                ...jadwal,
                                categoryName: category.name
                            }
                        };
                    }),
                    eventClick: function(info) {
                        showMaintenanceDetails(info.event.extendedProps);
                    },
                });

                calendar.render();
            });

            function showMaintenanceDetails(jadwal) {
                const storageUrl = "{{ asset('storage/fotos') }}";
                document.getElementById('detailTanggal').textContent = jadwal.tanggal;
                document.getElementById('detailWaktu').textContent = `${jadwal.jam_mulai} - ${jadwal.jam_berakhir}`;
                document.getElementById('detailDeskripsi').textContent = jadwal.deskripsi;
                document.getElementById('detailKategori').textContent = jadwal.categoryName || 'Kategori tidak ditemukan';
                document.getElementById('detailKegiatan').textContent = jadwal.kegiatan || '-';
                document.getElementById('detailJamSelesai').textContent = jadwal.jam_selesai || '-';

                // Clear previous images
                document.getElementById('carousel-before').innerHTML = '';
                document.getElementById('carousel-after').innerHTML = '';

                // Populate "Sebelum Maintenance" images
                if (jadwal.foto) {
                    const fotos = jadwal.foto.split(',');
                    fotos.forEach((foto, index) => {
                        const imgDiv = document.createElement('div');
                        imgDiv.classList.add('carousel-item', 'w-full', index === 0 ? 'block' : 'hidden');
                        imgDiv.innerHTML =
                            `<img src="${storageUrl}/${foto.trim()}" alt="Foto Sebelum Maintenance" class="w-full h-48 object-cover rounded-lg mb-4">`;
                        document.getElementById('carousel-before').appendChild(imgDiv);
                    });
                }

                // Conditionally populate "Sesudah Maintenance" images and label
                const afterMaintenanceContainer = document.querySelector('.after-maintenance');
                if (jadwal.foto_kedua) {
                    const fotosKedua = jadwal.foto_kedua.split(',');
                    fotosKedua.forEach((foto, index) => {
                        const imgDiv = document.createElement('div');
                        imgDiv.classList.add('carousel-item', 'w-full', index === 0 ? 'block' : 'hidden');
                        imgDiv.innerHTML =
                            `<img src="${storageUrl}/${foto.trim()}" alt="Foto Setelah Maintenance" class="w-full h-48 object-cover rounded-lg mb-4">`;
                        document.getElementById('carousel-after').appendChild(imgDiv);
                    });
                    // Show "Sesudah Maintenance" section if there are images
                    afterMaintenanceContainer.classList.remove('hidden');
                } else {
                    // Hide "Sesudah Maintenance" section if there are no images
                    afterMaintenanceContainer.classList.add('hidden');
                }

                openMaintenanceModal();
            }

            function openMaintenanceModal() {
                document.getElementById('maintenanceModal').classList.remove('hidden');
            }

            function closeMaintenanceModal() {
                document.getElementById('maintenanceModal').classList.add('hidden');
            }

            function moveSlide(type, direction) {
                const carousel = document.getElementById(`carousel-${type}`);
                const items = carousel.getElementsByClassName('carousel-item');
                let currentIndex = Array.from(items).findIndex(item => !item.classList.contains('hidden'));

                currentIndex += direction;
                if (currentIndex < 0) currentIndex = items.length - 1;
                else if (currentIndex >= items.length) currentIndex = 0;

                Array.from(items).forEach((item, index) => item.classList.toggle('hidden', index !== currentIndex));
            }

            function moveSlideSecond(jadwalId, direction) {
                const carousel = document.getElementById(`carousel-second-${jadwal.id}`);
                const items = carousel.getElementsByClassName('carousel-item');
                let currentIndex = Array.from(items).findIndex(item => !item.classList.contains('hidden'));

                currentIndex += direction;
                if (currentIndex < 0) currentIndex = items.length - 1;
                else if (currentIndex >= items.length) currentIndex = 0;

                Array.from(items).forEach((item, index) => item.classList.toggle('hidden', index !== currentIndex));
            }
        </script>
    </body>
@endsection
