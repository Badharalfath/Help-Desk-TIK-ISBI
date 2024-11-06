<header class="bg-white fixed top-0 left-0 w-full z-50 shadow-lg backdrop-blur-md">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="{{ route('home') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <span class="ml-3 text-xl">UPT TIK</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center space-x-4">
            <!-- Tentang TIK Dropdown -->
            <div class="relative group flex items-center">
                <a href="{{ route('home') }}"
                    class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">
                    Tentang TIK
                </a>
                <svg class="ml-1 w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="absolute hidden group-hover:block bg-white shadow-lg py-2 mt-1 w-48 left-0 top-10">
                    <a href="#sejarah-upt"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer scroll-to">Sejarah
                        UPT</a>
                    <a href="#fungsi-upt"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer scroll-to">Tugas &
                        Fungsi</a>
                </div>
            </div>
            <!-- Layanan Dropdown -->
            <div class="relative group flex items-center">
                <a href="#layanan-tik"
                    class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 cursor-pointer scroll-to">Layanan</a>
                <svg class="ml-1 w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="absolute hidden group-hover:block bg-white shadow-lg py-2 mt-1 w-48 left-0 top-10">
                    <a href="#internet-isbi"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer scroll-to">Akses
                        Internet</a>
                    <a href="#aplikasi-isbi"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer scroll-to">Aplikasi
                        &
                        Website</a>
                    <a href="#email-isbi"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm cursor-pointer scroll-to">Email</a>
                </div>
            </div>

            <!-- Registrasi Akun Dropdown -->
            <div class="relative group flex items-center">
                <a href="{{ route('reginternet') }}"
                    class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Registrasi
                    Akun</a>
                <svg class="ml-1 w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="absolute hidden group-hover:block bg-white shadow-lg py-2 mt-1 w-48 left-0 top-10">
                    <a href="{{ route('reginternet') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Akses Internet</a>
                    <a href="{{ route('regemail') }}"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Email</a>
                </div>
            </div>


            <!-- Monitoring -->
            <a href="{{ route('monitoring') }}"
                class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Monitoring</a>

            <!-- Maintenance -->
            <div class="relative group flex items-center">
                <a href="{{ route('maintenance') }}"
                    class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Maintenance</a>
            
            </div>

            <!-- FAQ Dropdown -->
            <div class="relative group flex items-center">
                <a href="{{ route('faq') }}"
                    class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">FAQ</a>
            </div>

            <!-- Laporan -->
            <a href="{{ route('complaint') }}"
                class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Laporan</a>

            <a href="{{ route('login') }}"
                class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500">Login</a>
        </nav>
    </div>
</header>
