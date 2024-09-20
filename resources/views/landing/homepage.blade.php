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
                <img class="object-cover w-full h-full" src="https://dummyimage.com/1920x1080/fff/64bccc" alt="Slide 3">
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
        <h2 id="sejarah-upt" class="text-3xl font-semibold mb-4">Sejarah UPT</h2>
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
        <h2 id="fungsi-upt" class="text-3xl font-semibold text-center mb-8">Tugas dan Fungsi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Tugas Section -->
            <div class="bg-gray-100 p-6 rounded shadow-lg animate-fade-up scroll-smooth">
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

<!-- Container Layanan TIK ISBI -->
<div class="bg-white py-12">
    <div class="container mx-auto px-5 text-center">
        <h1 id="layanan-tik" class="text-3xl font-semibold mb-4">Layanan TIK ISBI</h1>
        
        <p class="text-lg leading-relaxed mb-4">
            UPT TIK menyediakan berbagai layanan untuk mendukung kebutuhan teknologi informasi di kampus. Berikut adalah beberapa layanan utama yang kami sediakan:
        </p>
        <h2 id="internet-isbi" class="text-3xl font-semibold mb-4">Akses Internet</h2>

        <!-- Internet Section -->
        <div class="bg-gray-100 p-6 rounded shadow-lg mx-[200px]">
            <h3 class="text-xl font-bold mb-4">Akses Internet</h3>
            <ul class="list-disc ml-6 text-left">
                <li>Menyediakan koneksi internet yang stabil dan cepat di seluruh area kampus.</li>
                <li>Memfasilitasi akses Wi-Fi untuk mahasiswa, dosen, dan staf.</li>
                <li>Mengelola bandwidth untuk memastikan ketersediaan akses internet bagi semua pengguna.</li>
                <li>Memberikan dukungan teknis untuk permasalahan koneksi internet.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Container 2: Aplikasi & Website -->
<div class="bg-white py-12">
    <div class="container mx-auto px-5 text-center">
        <h1 id="aplikasi-isbi" class="text-3xl font-semibold mb-4">Aplikasi & Website</h1>
        <p class="text-lg leading-relaxed mb-4">
            UPT TIK menyediakan berbagai layanan untuk mendukung kebutuhan teknologi informasi di kampus. Berikut adalah beberapa layanan utama yang kami sediakan:
        </p>

        <!-- Aplikasi Web Section -->
        <div class="bg-gray-100 p-6 rounded shadow-lg mx-[200px]">
            <h3 class="text-xl font-bold mb-4">Aplikasi & Website</h3>
            <ul class="list-disc ml-6 text-left">
                <li>Mengembangkan dan memelihara aplikasi kampus untuk mendukung proses akademik dan administrasi.</li>
                <li>Menyediakan layanan hosting dan domain untuk website fakultas dan unit-unit di kampus.</li>
                <li>Menjaga keamanan dan performa aplikasi serta website kampus.</li>
                <li>Memberikan pelatihan dan panduan penggunaan aplikasi kampus kepada civitas akademika.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Container 3: Email -->
<div class="bg-white py-12">
    <div class="container mx-auto px-5 text-center">
        <h2 id="email-isbi" class="text-3xl font-semibold mb-4">Email</h2>
        <p class="text-lg leading-relaxed mb-4">
            UPT TIK menyediakan berbagai layanan untuk mendukung kebutuhan teknologi informasi di kampus. Berikut adalah beberapa layanan utama yang kami sediakan:
        </p>

        <!-- Email Section -->
        <div class="bg-gray-100 p-6 rounded shadow-lg animate-fade-up delay-100 scroll-smooth mx-[200px]">
            <h3 class="text-xl font-bold mb-4">Email</h3>
            <ul class="list-disc ml-6 text-left">
                <li>Menyediakan layanan email resmi untuk dosen, mahasiswa, dan staf.</li>
                <li>Mengelola sistem email kampus agar tetap aman dan terlindungi dari ancaman siber.</li>
                <li>Memastikan ketersediaan layanan email yang andal untuk komunikasi resmi di lingkungan kampus.</li>
                <li>Memberikan dukungan teknis terkait konfigurasi dan penggunaan layanan email.</li>
            </ul>
        </div>
    </div>
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

    document.querySelectorAll('.scroll-to').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                var offset = 150;

                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({

                    top: offsetPosition, // Adjust for fixed header
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

@endsection
