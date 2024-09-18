sidebar.blade.php
<aside class="fixed top-0 left-0 w-64 h-screen bg-gray-800 text-white shadow-md">
    <div class="p-4 flex items-center justify-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Help Desk Dashboard</a>
    </div>
    <nav class="mt-8">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('listjadwal') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Kelola Jadwal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tiket') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-ticket-alt mr-3"></i>
                    <span>Daftar Tiket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-user mr-3"></i>
                    <span>Daftar Pengguna</span>
                </a>
            </li>
            <li>
                <a href="{{ route('faq.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-question-circle mr-3"></i>
                    <span>Form FAQ</span>
                </a>

            </li>

        </ul>
    </nav>
</aside>
