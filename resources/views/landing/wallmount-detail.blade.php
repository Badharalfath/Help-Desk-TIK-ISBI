<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Home Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

</head>
<div class="container mx-auto p-4 mt-24 mb-[50px]">

    <form class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-center">Detail Wallmount</h1>
        @csrf
        <!-- Nama Wallmount -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium">Nama Wallmount</label>
            <input type="text" name="nama" id="nama" class="border rounded w-full py-2 px-3"
                value="{{ $wallmount->nama }}" readonly>
        </div>

        <!-- Lokasi -->
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="border rounded w-full py-2 px-3"
                value="{{ $wallmount->lokasi }}" readonly>
        </div>

        <!-- Perangkat -->
        <div class="mb-4">
            <label for="perangkat" class="block text-sm font-medium">Perangkat</label>
            @foreach ($wallmount->perangkat as $index => $perangkat)
                <input type="text" name="perangkat[]" class="border rounded w-full py-2 px-3 mt-2"
                    value="{{ $perangkat->nama_perangkat }}" readonly>
            @endforeach
        </div>
        <!-- Carousel Foto -->
        <div class="mb-4">
            <h2 class="text-lg font-medium mb-4">Foto Wallmount</h2>

            @php
                // Memecah string foto yang dipisahkan oleh koma menjadi array
                $fotos = explode(',', $wallmount->foto);
            @endphp

            @if(count($fotos) > 0 && $fotos[0] !== '')
                <div class="relative">
                    <div class="flex overflow-hidden" id="carousel-{{ $wallmount->id }}">
                        @foreach($fotos as $index => $foto)
                            <div
                                class="carousel-item w-full flex-shrink-0 transition-transform duration-500 {{ $index === 0 ? 'block' : 'hidden' }}">
                                <img src="{{ asset('storage/fotos/' . trim($foto)) }}" alt="Foto Wallmount"
                                    class="w-full h-full object-contain max-h-64 rounded-lg">
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                        onclick="moveSlide({{ $wallmount->id }}, -1)">&#10094;</button>
                    <button type="button" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow"
                        onclick="moveSlide({{ $wallmount->id }}, 1)">&#10095;</button>
                </div>
            @else
                <p class="text-gray-500">Tidak ada foto yang tersedia.</p>
            @endif
        </div>
    </form>
</div>

<script>
    let currentSlides = {};

// Function to move slides without page refresh
function moveSlide(wallmountId, direction) {
    const slides = document.querySelectorAll(`#carousel-${wallmountId} .carousel-item`);
    const totalSlides = slides.length;

    // Initialize current slide if not already
    if (!currentSlides[wallmountId]) {
        currentSlides[wallmountId] = 0;
    }

    // Update current slide index
    currentSlides[wallmountId] = (currentSlides[wallmountId] + direction + totalSlides) % totalSlides;

    // Hide all slides and show the current one
    slides.forEach((slide, index) => {
        slide.classList.add('hidden');
        if (index === currentSlides[wallmountId]) {
            slide.classList.remove('hidden');
        }
    });
}
</script>