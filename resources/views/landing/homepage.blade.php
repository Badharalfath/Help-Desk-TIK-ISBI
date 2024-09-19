@extends('layouts.homelayout')

@section('content')
    <!-- Div 1: Jumbotron with Carousel -->
    <div class="relative text-white ">
        <div class="swiper-container absolute inset-0 z-0 h-[60vh]">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080/000/fff" alt="Slide 1">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
                <div class="swiper-slide">
                    <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080" alt="Slide 2">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
                <div class="swiper-slide">
                    <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080/fff/64bccc"
                        alt="Slide 3">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                </div>
            </div>
        </div>

        <!-- Welcome Text -->
        <div class="relative z-10 container mx-auto px-5 py-24 flex flex-col items-start justify-center h-[60vh]">
            <h1 class="text-4xl sm:text-5xl font-bold">Selamat Datang di Helpdesk TIK</h1>
            <p class="mt-4 text-lg leading-relaxed">Kami di sini untuk membantu Anda dengan berbagai kebutuhan teknis
                dan informasi terkait teknologi informasi di Universitas Institut Seni Budaya Indonesia (ISBI) Bandung.</p>

        </div>
    </div>

    <!-- Div 2: Sejarah UPT TIK -->
    <div class="bg-gray-100 py-24 relative">
        <div class="container mx-auto px-5 text-center">
            <h2 class="text-3xl font-semibold mb-4">Sejarah UPT</h2>
            <p class="text-lg leading-relaxed mb-8">
                UPT Teknologi Informasi dan Komunikasi (TIK) di ISBI Bandung didirikan untuk mendukung kegiatan akademik dan
                administrasi
                melalui penerapan teknologi informasi yang efisien dan terkini. Lahir dari kebutuhan universitas untuk
                beradaptasi dengan
                perkembangan zaman, UPT TIK berfungsi sebagai pusat layanan dan pengelolaan infrastruktur IT.
            </p>

            <!-- Parallax Image -->
            <div class="relative">
                <div class="parallax bg-center bg-cover h-72"
                    style="background-image: url('https://dummyimage.com/1920x1080/000/fff');"></div>
                <div class="absolute inset-0 bg-blue-600 opacity-50 flex items-center justify-center">
                    <p class="text-white text-lg">"Bersama Teknologi, Kami Membangun Masa Depan"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Div 3: Tugas dan Fungsi UPT TIK -->
    <div class="bg-white py-24">
        <div class="container mx-auto px-5">
            <h2 class="text-3xl font-semibold text-center mb-8">Tugas dan Fungsi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Tugas Section -->
                <div id="sejarah-upt" class="bg-gray-100 p-6 rounded shadow-lg animate-fade-up scroll-smooth">
                    <h3 class="text-xl font-bold mb-4">Tugas UPT TIK</h3>
                    <ul class="list-disc ml-6 text-left">
                        <li>Mengelola infrastruktur jaringan dan server di lingkungan kampus.</li>
                        <li>Menyediakan layanan teknologi informasi yang berkualitas.</li>
                        <li>Membantu implementasi sistem informasi akademik dan administrasi.</li>
                        <li>Mendukung pengembangan e-learning dan multimedia.</li>
                    </ul>
                </div>

                <!-- Fungsi Section -->
                <div id="tugas-fungsi-upt"
                    class="bg-gray-100 p-6 rounded shadow-lg animate-fade-up delay-100 scroll-smooth">
                    <h3 class="text-xl font-bold mb-4">Fungsi UPT TIK</h3>
                    <ul class="list-disc ml-6 text-left">
                        <li>Meningkatkan efisiensi operasional melalui teknologi digital.</li>
                        <li>Memastikan ketersediaan layanan IT yang handal untuk seluruh sivitas akademika.</li>
                        <li>Menyediakan pelatihan dan dukungan IT kepada dosen, mahasiswa, dan staf.</li>
                        <li>Mengembangkan inovasi teknologi dalam pendidikan dan administrasi kampus.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <div class="w-full h-72 bg-gray-200 flex items-center justify-center">
        <p class="text-xl font-semibold">Container 1</p>
    </div>
    <div class="w-full h-72 bg-gray-200 flex items-center justify-center">
        <p class="text-xl font-semibold">Container 1</p>
    </div>
    <div class="w-full h-72 bg-gray-200 flex items-center justify-center">
        <p class="text-xl font-semibold">Container 1</p>
    </div>
    <div class="w-full h-72 bg-gray-200 flex items-center justify-center">
        <p class="text-xl font-semibold">Container 1</p>
    </div>
    <!-- Swiper Initialization Script -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
    </script>

@endsection
