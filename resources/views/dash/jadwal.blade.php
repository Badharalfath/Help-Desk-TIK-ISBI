@extends('layouts.homedash')

@section('content')
<main class="container mx-auto py-10">

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold pl-2">Daftar Pengguna</h2>

        <!-- Button tambah user -->

        <div class=" flex justify-end mb-4">
            <a href="{{ route('listjadwal') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Kembali ke Jadwal
            </a>
            <a href="{{ route('jadwal') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Tambah Jadwal
            </a>
        </div>
    </div>
    <div class="flex space-x-6 mb-4 bg-gray-50 p-2 max-w-[310px] rounded-lg">
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

    <div class="flex flex-col md:flex-row justify-center">

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
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
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

                <!-- Dropdown Kategori -->
                <div class="mb-4">
                    <label for="kd_layanan" class="block text-gray-700 font-bold mb-2">Pilih Kategori</label>
                    <select id="kd_layanan" name="kd_layanan" onchange="toggleWallmountSection(this.value)"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategoriLayanans as $layanan)
                            <option value="{{ $layanan->kd_layanan }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section that will display when Wallmount is selected -->
                <div id="wallmount-section" class="mb-4 hidden">
                    <label for="wallmount_id" class="block text-gray-700 font-bold mb-2">Pilih Wallmount</label>
                    <select id="wallmount_id" name="wallmount_id" onchange="fetchPerangkat(this.value)"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Pilih Wallmount</option>
                        @foreach ($wallmounts as $wallmount)
                            <option value="{{ $wallmount->id }}">{{ $wallmount->nama }} (lokasi: {{ $wallmount->lokasi }})
                            </option>
                        @endforeach
                    </select>
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
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure jadwals data is passed correctly to JavaScript
        const jadwals = @json($jadwals);

        // Mapping of kd_layanan to specific names (no longer used for colors)
        const layananDetails = {
            "LY001": { name: "Jaringan/Internet" },
            "LY002": { name: "Aplikasi" },
            "LY003": { name: "Email" },
            "LY004": { name: "Wallmount" }
        };

        // Mapping for kd_progres to background colors
        const progresColors = {
            "PG001": "#6B7280", // Pending - Gray
            "PG002": "#ed965c", // On going - Orange
            "PG003": "#67bf79"  // Complete - Green
        };

        const calendarEl = document.getElementById('calendar');

        // Function to get background color based on kd_progres
        function getProgressColor(kd_progres) {
            if (kd_progres === "PG001" || kd_progres === null) {
                return progresColors["PG001"]; // Use Pending color for both null and PG001
            }
            return progresColors[kd_progres] || "#6B7280"; // Default to gray if not found
        }

        // Initialize FullCalendar with events
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: jadwals.map(jadwal => {
                const name = layananDetails[jadwal.kd_layanan]?.name || "Unknown"; // Get service name
                const bgColor = getProgressColor(jadwal.kd_progres); // Get color based on progress

                return {
                    title: name,                 // Display the correct service name
                    start: jadwal.tanggal,       // Start date of event
                    backgroundColor: bgColor,    // Background color based on progress
                    borderColor: bgColor,
                    textColor: '#ffffff',
                    extendedProps: {
                        id: jadwal.id,
                        kegiatan: jadwal.kegiatan,
                        jam_mulai: jadwal.jam_mulai,
                        jam_berakhir: jadwal.jam_berakhir,
                        deskripsi: jadwal.deskripsi,
                        foto: jadwal.foto,
                        foto_kedua: jadwal.foto_kedua
                    }
                };
            }),
            @if ($isInput)
                dateClick: function (info) {
                    showMaintenanceDetails(info.dateStr); // Open detail view on date click
                },
                eventClick: function (info) {
                    showMaintenanceDetails(info.event.startStr); // Show details on event click
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
                        <form id="fotoKeduaForm" action="/jadwal/${jadwal.id}/update-foto-kedua" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="foto_kedua" class="block text-gray-700 font-bold mb-2">Input Foto Setelah Maintenance</label>
                                <input type="file" id="foto_kedua" name="foto_kedua[]" multiple required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="my-4">
                                <label for="kegiatan" class="text-lg font-bold text-gray-800">Kegiatan Maintenance</label>
                                <textarea id="kegiatan" name="kegiatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" required></textarea>
                            </div>
                            <div class="my-4">
                                 <input type="hidden" id="jam_selesai" name="jam_selesai" value="{{ now()->format('H:i:s') }}"> <!-- Hidden field for jam_selesai -->
                            </div>
                            <button type="submit" class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Submit
                            </button>
                        </form>`;
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
                        ${jadwal.layanan ? `
                            <div class="my-4">
                                <label for="kategori" class="text-lg font-bold text-gray-800">Kategori</label>
                                <input type="text" id="kategori" name="kategori"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    value="${jadwal.layanan.nama_layanan}" readonly>
                            </div>` : ''}
                        <div class="my-4">
                            <label for="pic" class="text-lg font-bold text-gray-800">Person In Charge</label>
                            <input type="pic" id="pic" name="pic" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" value="${jadwal.pic}" readonly>
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
                        <hr class="w-47 h-1 my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
                        <div class="my-4">
                            ${fotoKeduaHTML} <!-- Display second image or upload form -->
                        </div>
                        ${jadwal.kegiatan ? `
                        <div class="my-4">
                            <label for="kegiatan" class="text-lg font-bold text-gray-800">Kegiatan Maintenance</label>
                            <textarea id="kegiatan" name="kegiatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" readonly>${jadwal.kegiatan}</textarea>
                        </div>` : ''}
                        ${jadwal.jam_selesai ? `
                                <div class="my-4">
                                    <label for="jam_selesai" class="text-lg font-bold text-gray-800">Jam Selesai</label>
                                    <input type="text" id="jam_selesai" name="jam_selesai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="${jadwal.jam_selesai}" readonly>
                                </div>` : ''}
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

    function toggleWallmountSection(kdLayanan) {
        const wallmountSection = document.getElementById('wallmount-section');

        // Tampilkan atau sembunyikan section berdasarkan kode layanan
        if (kdLayanan === 'LY004') {
            wallmountSection.classList.remove('hidden'); // Tampilkan
        } else {
            wallmountSection.classList.add('hidden'); // Sembunyikan
        }
    }
</script>

</body>
@endsection
