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
                 <!-- Ubah nama Kelola Jadwal menjadi Maintenance dan tambahkan cursor-pointer -->
                <a href="javascript:void(0);" onclick="toggleDropdown('maintenance-dropdown')"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white cursor-pointer">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Maintenance</span>
                    <i class="fas fa-chevron-down ml-auto transition-transform transform rotate-chevron"></i>
                </a>
                <!-- Sub-menu untuk Jadwal Maintenance dan Wallmount dengan animasi -->
                <ul id="maintenance-dropdown" class="ml-6 space-y-2 overflow-hidden transition-all duration-300 max-h-0">
                    <li>
                        <a href="{{ route('listjadwal') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-calendar-day mr-3 text-sm"></i>
                            <span class="text-sm">Jadwal Maintenance</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wallmount.index') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tools mr-3 text-sm"></i>
                            <span class="text-sm">Wallmount</span>
                        </a>
                    </li>
                </ul>
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

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const chevron = dropdown.previousElementSibling.querySelector('.rotate-chevron'); // Pilih ikon chevron
        
        if (dropdown.style.maxHeight) {
            // Jika dropdown terbuka, sembunyikan dengan transisi
            dropdown.style.maxHeight = null;
            chevron.classList.remove('rotate-180'); // Kembalikan ikon panah
        } else {
            // Jika dropdown tertutup, buka dengan transisi
            dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            chevron.classList.add('rotate-180'); // Putar ikon panah ke atas
        }
    }
</script>

<style>
    /* Tambahkan class rotate-180 untuk memutar ikon panah */
    .rotate-180 {
        transform: rotate(180deg);
    }
</style>