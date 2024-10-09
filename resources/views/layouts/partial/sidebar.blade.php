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
                <a href="javascript:void(0);" onclick="toggleDropdown('maintenance-dropdown')"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white cursor-pointer">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Maintenance</span>
                    <i class="fas fa-chevron-down ml-auto transition-transform transform rotate-chevron"></i>
                </a>
                <ul id="maintenance-dropdown"
                    class="ml-6 space-y-2 overflow-hidden transition-all duration-300 max-h-0">
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
            <!-- Tambahan Dropdown Manajemen Asset -->
            <li>
                <a href="javascript:void(0);" onclick="toggleDropdown('asset-dropdown')"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white cursor-pointer">
                    <i class="fas fa-boxes mr-3"></i>
                    <span>Manajemen Asset</span>
                    <i class="fas fa-chevron-down ml-auto transition-transform transform rotate-chevron"></i>
                </a>
                <ul id="asset-dropdown" class="ml-6 space-y-2 overflow-hidden transition-all duration-300 max-h-0">
                    <li>
                        <a href="{{ route('barang') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-box mr-3 text-sm"></i>
                            <span class="text-sm">Data Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departemen') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-building mr-3 text-sm"></i>
                            <span class="text-sm">Data Departemen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tags mr-3 text-sm"></i>
                            <span class="text-sm">Data Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lokasi') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-map-marker-alt mr-3 text-sm"></i>
                            <span class="text-sm">Data Lokasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penempatan') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-warehouse mr-3 text-sm"></i>
                            <span class="text-sm">Data Penempatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tambah-pengadaan') }}"
                            class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-shopping-cart mr-3 text-sm"></i>
                            <span class="text-sm">Data Pengadaan</span>
                        </a>

                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const chevron = dropdown.previousElementSibling.querySelector('.rotate-chevron');

        if (dropdown.style.maxHeight) {
            dropdown.style.maxHeight = null;
            chevron.classList.remove('rotate-180');
        } else {
            dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            chevron.classList.add('rotate-180');
        }
    }
</script>

<style>
    .rotate-180 {
        transform: rotate(180deg);
    }
</style>
