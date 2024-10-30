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
                    <textarea name="keluhan" placeholder="Complaint" class="w-full p-2 border border-gray-300 rounded" readonly>{{ $ticket->keluhan }}</textarea>
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


                <!-- Bagan Status -->
                <label for="status">Status</label>
                <div class="mb-4 flex justify-around">
                    <!-- Tombol Reject -->
                    <label class="relative flex items-center cursor-pointer">
                        <input type="radio" name="kd_status" value="ST002" id="status_reject"
                            {{ $ticket->kd_status == 'ST002' ? 'checked' : '' }} class="hidden"
                            onchange="updateStatusStyles()">
                        <span id="reject_button"
                            class="px-4 py-2 border border-red-500 rounded-md
                   {{ $ticket->kd_status == 'ST002' ? 'bg-red-500 text-white' : 'text-red-500' }}
                   hover:bg-red-500 hover:text-white transition">
                            Reject
                        </span>
                    </label>
                    <!-- Tombol Approved -->
                    <label class="relative flex items-center cursor-pointer">
                        <input type="radio" name="kd_status" value="ST001" id="status_approved"
                            {{ $ticket->kd_status == 'ST001' ? 'checked' : '' }} class="hidden"
                            onchange="updateStatusStyles()">
                        <span id="approved_button"
                            class="px-4 py-2 border border-green-500 rounded-md
                   {{ $ticket->kd_status == 'ST001' ? 'bg-green-500 text-white' : 'text-green-500' }}
                   hover:bg-green-500 hover:text-white transition">
                            Approved
                        </span>
                    </label>
                </div>

                <!-- Bagian untuk input Reject Reason -->
                <div id="reject_reason_container" style="{{ $ticket->kd_status == 'ST002' ? '' : 'display: none;' }}">
                    <label for="reject_reason" class="block text-sm font-medium text-gray-700">Reject Reason</label>
                    <input type="text" name="reject_reason" id="reject_reason"
                        value="{{ $ticket->reject_reason ?? '' }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Bagan Progress -->
<label for="kd_progres">Progress</label>
<div class="mb-4 flex justify-around">
    <!-- Tombol Pending -->
    <label class="relative flex items-center cursor-pointer">
        <input type="radio" name="kd_progres" value="PG001" id="progress_pending"
            {{ $ticket->kd_progres == 'PG001' ? 'checked' : '' }}
            class="hidden" onchange="updateProgressStyles()">
        <span id="pending_button"
            class="px-4 py-2 border border-gray-500 rounded-md
                   {{ $ticket->kd_progres == 'PG001' ? 'bg-gray-500 text-white' : 'text-gray-500' }}
                   hover:bg-gray-500 hover:text-white transition">
            Pending
        </span>
    </label>
    <!-- Tombol Ongoing -->
    <label class="relative flex items-center cursor-pointer">
        <input type="radio" name="kd_progres" value="PG002" id="progress_ongoing"
            {{ $ticket->kd_progres == 'PG002' ? 'checked' : '' }}
            class="hidden" onchange="updateProgressStyles()">
        <span id="ongoing_button"
            class="px-4 py-2 border border-orange-500 rounded-md
                   {{ $ticket->kd_progres == 'PG002' ? 'bg-orange-500 text-white' : 'text-orange-500' }}
                   hover:bg-orange-500 hover:text-white transition">
            Ongoing
        </span>
    </label>
    <!-- Tombol Complete -->
    <label class="relative flex items-center cursor-pointer">
        <input type="radio" name="kd_progres" value="PG003" id="progress_complete"
            {{ $ticket->kd_progres == 'PG003' ? 'checked' : '' }}
            class="hidden" onchange="updateProgressStyles()">
        <span id="complete_button"
            class="px-4 py-2 border border-blue-500 rounded-md
                   {{ $ticket->kd_progres == 'PG003' ? 'bg-blue-500 text-white' : 'text-blue-500' }}
                   hover:bg-blue-500 hover:text-white transition">
            Complete
        </span>
    </label>
</div>

                <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded">Save</button>
            </form>
        </div>
    </div>


    <script>
        function updateStatusStyles() {
            const isRejectSelected = document.getElementById('status_reject').checked;
            const rejectButton = document.getElementById('reject_button');
            const approvedButton = document.getElementById('approved_button');

            if (isRejectSelected) {
                rejectButton.classList.add('bg-red-500', 'text-white');
                rejectButton.classList.remove('text-red-500');
                approvedButton.classList.remove('bg-green-500', 'text-white');
                approvedButton.classList.add('text-green-500');
            } else {
                approvedButton.classList.add('bg-green-500', 'text-white');
                approvedButton.classList.remove('text-green-500');
                rejectButton.classList.remove('bg-red-500', 'text-white');
                rejectButton.classList.add('text-red-500');
            }

            toggleRejectReason();
        }

        function updateProgressStyles() {
        const pendingButton = document.getElementById('pending_button');
        const ongoingButton = document.getElementById('ongoing_button');
        const completeButton = document.getElementById('complete_button');

        pendingButton.classList.toggle('bg-gray-500', document.getElementById('progress_pending').checked);
        pendingButton.classList.toggle('text-white', document.getElementById('progress_pending').checked);
        pendingButton.classList.toggle('text-gray-500', !document.getElementById('progress_pending').checked);

        ongoingButton.classList.toggle('bg-orange-500', document.getElementById('progress_ongoing').checked);
        ongoingButton.classList.toggle('text-white', document.getElementById('progress_ongoing').checked);
        ongoingButton.classList.toggle('text-orange-500', !document.getElementById('progress_ongoing').checked);

        completeButton.classList.toggle('bg-blue-500', document.getElementById('progress_complete').checked);
        completeButton.classList.toggle('text-white', document.getElementById('progress_complete').checked);
        completeButton.classList.toggle('text-blue-500', !document.getElementById('progress_complete').checked);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateProgressStyles();



            document.querySelectorAll('input[name="kd_status"]').forEach(radio => {
                radio.addEventListener('change', updateStatusStyles);
            });

            document.querySelectorAll('input[name="kd_progres"]').forEach(radio => {
            radio.addEventListener('change', updateProgressStyles);
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleRejectReason() {
                const selectedStatus = document.querySelector('input[name="kd_status"]:checked').value;
                const rejectReasonContainer = document.getElementById('reject_reason_container');

                if (selectedStatus === 'ST002') {
                    rejectReasonContainer.style.display = 'block';
                } else {
                    rejectReasonContainer.style.display = 'none';
                }
            }

            toggleRejectReason();

            document.querySelectorAll('input[name="kd_status"]').forEach(radio => {
                radio.addEventListener('change', toggleRejectReason);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            prevButton.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah refresh/redirect
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalImages - 1;
                }
                updateCarousel();
            });

            nextButton.addEventListener('click', function(event) {
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
