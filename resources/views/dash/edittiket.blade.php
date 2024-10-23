@extends('layouts.homedash')

@section('content')

<!-- Main Content -->
<div class="flex-grow flex justify-center items-center mt-[50px] mb-[50px]">
    <div class="bg-white text-black rounded-lg shadow-lg p-8 w-full max-w-[1000px]">
        <h2 class="text-2xl font-semibold text-center ">Ticket Details</h2>
        <hr class="w-[240px] h-1 mx-auto mt-2 mb-4 bg-gray-100 border-0 rounded dark:bg-gray-700">

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <div class="text-black">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('ticket.update', $ticket->id) }}" method="POST">
            @csrf
            <h1 class="text-1xl font-semibold text-left ">Email</h1>

            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" value="{{ $ticket->email }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
            </div>
            <h1 class="text-1xl font-semibold text-left ">Nama</h1>

            <div class="mb-4">
                <input type="text" name="name" placeholder="Name" value="{{ $ticket->name }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
            </div>
            <h1 class="text-1xl font-semibold text-left ">Judul</h1>

            <div class="mb-4">
                <input type="text" name="judul" placeholder="Complaint Title" value="{{ $ticket->judul }}"
                    class="w-full p-2 border border-gray-300 rounded" readonly>
            </div>
            <h1 class="text-1xl font-semibold text-left ">Deskripsi</h1>

            <div class="mb-2">
                <textarea name="keluhan" placeholder="Complaint" class="w-full p-2 border border-gray-300 rounded"
                    readonly>{{ $ticket->keluhan }}</textarea>
            </div>



            @if ($ticket->kategori == 'Jaringan')
                <h1 class="text-1xl font-semibold text-left ">Lokasi</h1>
                <div class="mb-4">
                    <input type="text" name="lokasi" placeholder="Location" value="{{ $ticket->lokasi }}"
                        class="w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            @endif
            <h1 class="text-1xl font-semibold text-left ">Gambar</h1>

            <!-- Bagian untuk menampilkan foto keluhan dalam bentuk carousel -->
            <div class="mt-2 p-2 border rounded-lg shadow-md bg-white relative">
                @php
                    $fotoKeluhanArray = $ticket->foto_keluhan ? explode(',', $ticket->foto_keluhan) : [];
                @endphp

                @if (!empty($fotoKeluhanArray))
                    <!-- Wrapper untuk carousel -->
                    <div id="carousel" class="relative overflow-hidden w-full h-auto max-w-md mx-auto">
                        <!-- Container gambar -->
                        <div id="carousel-images" class="flex transition-transform duration-300 ease-in-out">
                            @foreach ($fotoKeluhanArray as $foto)
                                <div class="min-w-full">
                                    <img src="{{ Storage::url('fotos/' . $foto) }}" alt="Foto Keluhan"
                                        class="w-full h-auto object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol untuk navigasi -->
                    <div id="prev"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full hover:bg-gray-700 cursor-pointer">
                        &#60;
                    </div>
                    <div id="next"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-2 rounded-full hover:bg-gray-700 cursor-pointer">
                        &#62;
                    </div>
                @else
                    <!-- Placeholder jika tidak ada foto -->
                    <img src="{{ asset('images/default-placeholder.png') }}" alt="Foto Keluhan"
                        class="w-full h-auto max-w-md mx-auto">
                @endif
            </div>


            <!-- Bagan status -->
            <label for="status">Status</label>
            <div class="mb-4 flex justify-around">
                <div class="relative">
                    <select name="kd_status" id="status_select"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($kategoriStatus as $status)
                            <option value="{{ $status->kd_status }}" {{ $ticket->kd_status == $status->kd_status ? 'selected' : '' }}>
                                {{ $status->nama_status }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Bagian untuk input reject reason --}}
            <div id="reject_reason_container" style="{{ ($ticket->kd_status == 'ST002') ? '' : 'display: none;' }}">
                <label for="reject_reason" class="block text-sm font-medium text-gray-700">Reject Reason</label>
                <input type="text" name="reject_reason" id="reject_reason" value="{{ $ticket->reject_reason ?? '' }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Bagan progress -->
            <label for="progress">Progress</label>
            <div class="mb-4 flex justify-around">
                <div class="relative">
                    <select name="kd_progres" id="status_select"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($kategoriProgres as $progres)
                            <option value="{{ $progres->kd_progres }}" {{ $ticket->kd_progress == $progres->kd_progres ? 'selected' : '' }}>
                                {{ $progres->nama_progres }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('status_select');
        var rejectReasonContainer = document.getElementById('reject_reason_container');

        // Fungsi untuk menampilkan atau menyembunyikan reject reason
        function toggleRejectReason() {
            var selectedValue = statusSelect.value;

            // Cek apakah status terpilih adalah rejected (ST002)
            if (selectedValue === 'ST002') {
                rejectReasonContainer.style.display = 'block';
            } else {
                rejectReasonContainer.style.display = 'none';
            }
        }

        // Panggil fungsi saat halaman dimuat
        toggleRejectReason();

        // Tambahkan event listener untuk memonitor perubahan pada select status
        statusSelect.addEventListener('change', function() {
            toggleRejectReason();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('#carousel-images > div');
        const totalImages = images.length;
        let currentIndex = 0;

        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const carouselImages = document.getElementById('carousel-images');

        function updateCarousel() {
            // Hitung posisi gambar berdasarkan index saat ini
            const translateX = -currentIndex * 100;
            carouselImages.style.transform = `translateX(${translateX}%)`;
        }

        prevButton.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah refresh/redirect
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = totalImages - 1;
            }
            updateCarousel();
        });

        nextButton.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah refresh/redirect
            if (currentIndex < totalImages - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        });
    });
</script>

</body>

</html>
@endsection