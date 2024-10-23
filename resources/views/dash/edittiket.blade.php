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
                <h2 class="text-base font-semibold text-center mb-2 mt-2">Status</h2>
                <hr class="w-48 h-1 mx-auto my-2 bg-gray-100 border-0 rounded dark:bg-gray-700 mb-6">

                <div class="mb-4 flex justify-around">
                    <div class="relative" style="{{ $ticket->status == 'approved' ? 'display: none;' : '' }}">
                        <input type="radio" name="status" id="permission_rejected" value="rejected"
                            class="hidden peer" {{ $ticket->status == 'rejected' ? 'checked' : '' }}
                            onclick="toggleFields()">
                        <label for="permission_rejected"
                            class="flex items-center gap-4 p-4 rounded-xl bg-white bg-opacity-90 backdrop-blur-2xl shadow-xl hover:bg-opacity-75 peer-checked:bg-red-400 peer-checked:text-white cursor-pointer transition">
                            <div>
                                <h1 class="text-base text-center">Rejected</h1>
                            </div>
                        </label>
                    </div>

                    <div class="relative">
                        <input type="radio" name="status" id="permission_approved" value="approved"
                            class="hidden peer" {{ $ticket->status == 'approved' ? 'checked' : '' }}
                            onclick="toggleFields()">
                        <label for="permission_approved"
                            class="flex items-center gap-4 p-4 rounded-xl bg-white bg-opacity-90 backdrop-blur-2xl shadow-xl hover:bg-opacity-75 peer-checked:bg-green-300 peer-checked:text-white cursor-pointer transition">
                            <div>
                                <h1 class="text-base text-center">Approved</h1>
                            </div>
                        </label>
                    </div>
                </div>


                <!-- Bagan Progress -->
                <div class="mb-4" id="reject_reason_container"
                    style="display: {{ $ticket->status == 'rejected' ? 'block' : 'none' }};">
                    <input type="text" name="reject_reason" placeholder="Reject Reason"
                        value="{{ $ticket->reject_reason }}" class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div id="status_container"
                    style="display: {{ $ticket->status == 'approved' ? 'block' : 'none' }};">
                    <h2 class="text-base font-semibold text-center mb-4">Progress</h2>
                    <hr class="w-48 h-1 mx-auto my-2 bg-gray-100 border-0 rounded dark:bg-gray-700">

                    <div class="mb-4 flex justify-around">

                        <div class="relative">
                            <input type="radio" name="progress" id="progress_ongoing" value="ongoing"
                                class="hidden peer" {{ $ticket->progress == 'ongoing' ? 'checked' : '' }}>
                            <label for="progress_ongoing"
                                class="flex items-center gap-4 p-4 rounded-xl bg-white bg-opacity-90 backdrop-blur-2xl shadow-xl hover:bg-opacity-75 peer-checked:bg-gray-600 peer-checked:text-white cursor-pointer transition">
                                <div>
                                    <h1 class="text-base text-center">On Going</h1>
                                </div>
                            </label>
                        </div>

                        <div class="relative">
                            <input type="radio" name="progress" id="progress_solved" value="solved"
                                class="hidden peer" {{ $ticket->progress == 'solved' ? 'checked' : '' }}>
                            <label for="progress_solved"
                                class="flex items-center gap-4 p-4 rounded-xl bg-white bg-opacity-90 backdrop-blur-2xl shadow-xl hover:bg-opacity-75 peer-checked:bg-gray-600 peer-checked:text-white cursor-pointer transition">
                                <div>
                                    <h1 class="text-base text-center">Solved</h1>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded">Save</button>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const rejectRadio = document.getElementById('permission_rejected');
            const approvedRadio = document.getElementById('permission_approved');
            const rejectReasonContainer = document.getElementById('reject_reason_container');
            const statusContainer = document.getElementById('status_container');

            if (rejectRadio.checked) {
                rejectReasonContainer.style.display = 'block';
                statusContainer.style.display = 'none';
            } else if (approvedRadio.checked) {
                rejectReasonContainer.style.display = 'none';
                statusContainer.style.display = 'block';
            } else {
                rejectReasonContainer.style.display = 'none';
                statusContainer.style.display = 'none';
            }
        }

        // Call function on page load in case one of the options was already selected
        toggleFields();
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
