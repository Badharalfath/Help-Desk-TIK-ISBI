<!-- 
<header class="bg-white fixed top-0 left-0 w-full z-50 shadow-lg backdrop-blur-md">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="{{ route('home') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <span class="ml-3 text-xl">HELP DESK</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a href="{{ route('maintenance') }}" class="relative border-2 border-gray-800 bg-transparent py-2.5 px-5 font-medium uppercase text-gray-800 transition-colors before:absolute before:left-0 before:top-0 before:-z-10 before:h-full before:w-full before:origin-top-left before:scale-x-0 before:bg-gray-800 before:transition-transform before:duration-300 before:content-[''] hover:text-white before:hover:scale-x-100 mr-4">Maintenance</a>
            <a href="{{ route('monitoring') }}" class="relative border-2 border-gray-800 bg-transparent py-2.5 px-5 font-medium uppercase text-gray-800 transition-colors before:absolute before:left-0 before:top-0 before:-z-10 before:h-full before:w-full before:origin-top-left before:scale-x-0 before:bg-gray-800 before:transition-transform before:duration-300 before:content-[''] hover:text-white before:hover:scale-x-100 mr-4">Monitoring</a>
            <a href="{{ route('faq') }}" class="relative border-2 border-gray-800 bg-transparent py-2.5 px-5 font-medium uppercase text-gray-800 transition-colors before:absolute before:left-0 before:top-0 before:-z-10 before:h-full before:w-full before:origin-top-left before:scale-x-0 before:bg-gray-800 before:transition-transform before:duration-300 before:content-[''] hover:text-white before:hover:scale-x-100 mr-4">Pelaporan</a>
            <a href="{{ route('login') }}" class="relative border-2 border-gray-800 bg-transparent py-2.5 px-5 font-medium uppercase text-gray-800 transition-colors before:absolute before:left-0 before:top-0 before:-z-10 before:h-full before:w-full before:origin-top-left before:scale-x-0 before:bg-gray-800 before:transition-transform before:duration-300 before:content-[''] hover:text-white before:hover:scale-x-100 mr-4">Login</a>
        </nav>
    </div>
</header> -->

<header class="bg-white fixed top-0 left-0 w-full z-50 shadow-lg backdrop-blur-md">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="{{ route('home') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <span class="ml-3 text-xl">HELP DESK</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center space-x-4">
            <!-- Tentang TIK Dropdown -->
            <div class="relative group">
                <a href="#" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 flex items-center">
                    Tentang TIK
                    <!-- Ikon Panah ke Bawah -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4.24 4.19a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Perbaikan padding pada dropdown -->
                <div class="absolute left-0 mt-1 hidden group-hover:block bg-white shadow-lg py-2 w-48 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 pointer-events-auto delay-200">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Sejarah UPT</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Tugas & Fungsi</a>
                </div>
            </div>

            <!-- Layanan Dropdown -->
            <div class="relative group">
                <a href="#" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 flex items-center">
                    Layanan
                    <!-- Ikon Panah ke Bawah -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4.24 4.19a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div class="absolute left-0 mt-1 hidden group-hover:block bg-white shadow-lg py-2 w-48 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 pointer-events-auto delay-200">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Akses Internet</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Aplikasi & Website</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Email</a>
                </div>
            </div>

            <!-- Monitoring -->
            <a href="{{ route('monitoring') }}" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Monitoring</a>

            <!-- FAQ Dropdown -->
            <div class="relative group">
                <a href="#" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 flex items-center">
                    FAQ
                    <!-- Ikon Panah ke Bawah -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4.24 4.19a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div class="absolute left-0 mt-1 hidden group-hover:block bg-white shadow-lg py-2 w-48 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 pointer-events-auto delay-200">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Internet/Network</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Aplikasi/Email</a>
                </div>
            </div>

            <!-- Registrasi Akun Dropdown -->
            <div class="relative group">
                <a href="#" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 flex items-center">
                    Registrasi Akun
                    <!-- Ikon Panah ke Bawah -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4.24 4.19a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div class="absolute left-0 mt-1 hidden group-hover:block bg-white shadow-lg py-2 w-48 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 pointer-events-auto delay-200">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Akses Internet</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Email</a>
                </div>
            </div>

            <!-- Laporan -->
            <a href="{{ route('faq') }}" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Laporan</a>

            <!-- Maintenance -->
            <a href="{{ route('maintenance') }}" class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Maintenance</a>
        </nav>
    </div>
</header>
