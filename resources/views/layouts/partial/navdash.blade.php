<aside class="fixed top-0 left-0 w-64 h-screen bg-gray-800 text-white shadow-md">
    <div class="p-4 flex items-center justify-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Dashboard Admin</a>
    </div>
    <nav class="mt-8">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jadwal') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Kelola Jadwal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tiket') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-ticket-alt mr-3"></i>
                    <span>Daftar Tiket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('faq') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" class="mr-3 fill-current text-white">
                        <path d="M17 11.8045C17 11.4588 17 11.286 17.052 11.132C17.2032 10.6844 17.6018 10.5108 18.0011 10.3289C18.45 10.1244 18.6744 10.0222 18.8968 10.0042C19.1493 9.98378 19.4022 10.0382 19.618 10.1593C19.9041 10.3198 20.1036 10.6249 20.3079 10.873C21.2513 12.0188 21.7229 12.5918 21.8955 13.2236C22.0348 13.7334 22.0348 14.2666 21.8955 14.7764C21.6438 15.6979 20.8485 16.4704 20.2598 17.1854C19.9587 17.5511 19.8081 17.734 19.618 17.8407C19.4022 17.9618 19.1493 18.0162 18.8968 17.9958C18.6744 17.9778 18.45 17.8756 18.0011 17.6711C17.6018 17.4892 17.2032 17.3156 17.052 16.868C17 16.714 17 16.5412 17 16.1955V11.8045Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M7 11.8046C7 11.3694 6.98778 10.9782 6.63591 10.6722C6.50793 10.5609 6.33825 10.4836 5.99891 10.329C5.55001 10.1246 5.32556 10.0224 5.10316 10.0044C4.43591 9.9504 4.07692 10.4058 3.69213 10.8732C2.74875 12.019 2.27706 12.5919 2.10446 13.2237C1.96518 13.7336 1.96518 14.2668 2.10446 14.7766C2.3562 15.6981 3.15152 16.4705 3.74021 17.1856C4.11129 17.6363 4.46577 18.0475 5.10316 17.996C5.32556 17.978 5.55001 17.8757 5.99891 17.6713C6.33825 17.5167 6.50793 17.4394 6.63591 17.3281C6.98778 17.0221 7 16.631 7 16.1957V11.8046Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M20 10.5V9C20 5.13401 16.4183 2 12 2C7.58172 2 4 5.13401 4 9V10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20 17.5C20 22 16 22 12 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Form FAQ</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
