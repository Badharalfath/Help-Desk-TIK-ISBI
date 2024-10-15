<div class="container mx-auto p-8">
    <form action="{{ route('penempatan.update', $penempatan->kd_penempatan) }}" method="POST" class="max-w-lg mx-auto p-4">
        @csrf
        @method('PUT')

        <!-- No. Penempatan (Readonly) -->
        <div class="mb-4">
            <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penggunaan</label>
            <input type="text" id="kd_penempatan" name="kd_penempatan" value="{{ $penempatan->kd_penempatan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Kode Barang (Readonly) -->
        <div class="mb-4">
            <label for="kd_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
            <input type="text" id="kd_barang" name="kd_barang" value="{{ $penempatan->kd_barang }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Nama Barang (Readonly) -->
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $penempatan->nama_barang }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Tanggal Penempatan -->
        <div class="mb-4">
            <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penggunaan</label>
            <input type="date" id="tgl_penempatan" name="tgl_penempatan" value="{{ $penempatan->tgl_penempatan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Keterangan -->
        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" value="{{ $penempatan->keterangan }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

      

        <!-- Bagian untuk menampilkan foto penempatan dalam bentuk carousel -->
        <div class="mt-2 p-2 border rounded-lg shadow-md bg-white relative">
            @php
                $fotoPenempatanArray = $penempatan->foto_penempatan ? explode(',', $penempatan->foto_penempatan) : [];
            @endphp

            @if (!empty($fotoPenempatanArray))
                <!-- Wrapper untuk carousel -->
                <div id="carousel" class="relative overflow-hidden w-full h-auto max-w-md mx-auto">
                    <!-- Container gambar -->
                    <div id="carousel-images" class="flex transition-transform duration-300 ease-in-out">
                        @foreach ($fotoPenempatanArray as $foto) <!-- Ensure $foto is defined in this scope -->
                            @php
                                // Trim whitespace from the filename and build the image URL
                                $trimmedFoto = trim($foto);
                                $imagePath = Storage::url('fotos/' . $trimmedFoto);
                            @endphp
                            <div class="min-w-full">
                                <img src="{{ $imagePath }}" alt="Foto Penempatan"
                                     class="w-full h-auto object-cover"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-placeholder.png') }}'">
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
                <img src="{{ asset('images/default-placeholder.png') }}" alt="Foto Penempatan"
                     class="w-full h-auto max-w-md mx-auto">
            @endif
        </div>


    </form>
</div>
<script>
    // JavaScript untuk mengontrol navigasi carousel
    document.addEventListener('DOMContentLoaded', function () {
        const imagesContainer = document.getElementById('carousel-images');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        let currentIndex = 0;

        // Fungsi untuk menavigasi ke gambar sebelumnya
        prevButton.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        // Fungsi untuk menavigasi ke gambar selanjutnya
        nextButton.addEventListener('click', function () {
            if (currentIndex < imagesContainer.children.length - 1) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Memperbarui posisi gambar yang ditampilkan
        function updateCarousel() {
            const offset = -currentIndex * 100; // Menggeser berdasarkan index
            imagesContainer.style.transform = `translateX(${offset}%)`;
        }
    });
</script>
