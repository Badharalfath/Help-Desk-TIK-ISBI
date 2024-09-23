@extends('layouts.homedash')

@section('content')

    <div class="overflow-x-auto mt-3 py-6 px-16"><!-- Dropdown untuk memilih kategori -->
        <div class="flex justify-start mb-4">
            <select id="faqCategoryDropdown" class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-1/3 p-2" onchange="filterFaqs()">
                <option value="it">Internet dan Jaringan</option>
                <option value="apps">Aplikasi dan Email</option>
            </select>
        </div>


        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div id="faqContainer">
            <!-- Tabel akan di-generate dengan JavaScript sesuai dengan kategori yang dipilih -->
        </div>

        <!-- Modal untuk detail -->
        <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden ">
            <div class="bg-white p-5 rounded shadow-lg w-4/5 h-4/5 overflow-y-auto relative">
                <h3 class="text-lg font-bold mb-4 mt-10">Detail Masalah</h3>
                <div id="modalContent"></div>
                <button class="absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"
                    onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        let itFaqs = @json($itFaqs); // Data IT FAQ
        let appsFaqs = @json($appsFaqs); // Data Apps FAQ
        let currentSortField = null;
        let currentSortDirection = 'asc';
        let currentPage = 1;
        const rowsPerPage = 5;

        document.addEventListener("DOMContentLoaded", function () {
            filterFaqs(); // Default tampilkan kategori pertama
        });

        function filterFaqs() {
            const category = document.getElementById('faqCategoryDropdown').value;
            let faqs = category === 'it' ? itFaqs : appsFaqs;
            currentPage = 1; // Reset ke halaman 1 saat mengganti kategori
            displayFaqTable(faqs);
        }

        function displayFaqTable(faqs) {
            const faqContainer = document.getElementById('faqContainer');
            let tableHTML = `
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700 cursor-pointer" onclick="sortTable('id')">ID</th>
                            <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700 cursor-pointer" onclick="sortTable('nama_masalah')">Nama Masalah</th>
                            <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody>`;

            const sortedFaqs = sortFaqs(faqs);
            const paginatedFaqs = paginate(sortedFaqs, currentPage, rowsPerPage);

            paginatedFaqs.forEach(faq => {
                tableHTML += `
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b text-sm text-gray-600">${faq.id}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-600">${faq.nama_masalah}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-600">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded" onclick="showDetails(${faq.id})">Detail</button>
                            <a href="/faq/${faq.id}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Edit</a>
                            <form action="/faq/${faq.id}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>`;
            });

            tableHTML += `
                    </tbody>
                </table>
                <div class="mt-4 flex justify-center space-x-2">
                    ${generatePaginationButtons(faqs.length)}
                </div>`;

            faqContainer.innerHTML = tableHTML;
        }

        function sortTable(field) {
            if (currentSortField === field) {
                currentSortDirection = currentSortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                currentSortField = field;
                currentSortDirection = 'asc';
            }
            filterFaqs();
        }

        function sortFaqs(faqs) {
            if (!currentSortField) return faqs;
            return faqs.sort((a, b) => {
                if (currentSortDirection === 'asc') {
                    return a[currentSortField] > b[currentSortField] ? 1 : -1;
                } else {
                    return a[currentSortField] < b[currentSortField] ? 1 : -1;
                }
            });
        }

        function paginate(items, currentPage, rowsPerPage) {
            const startIndex = (currentPage - 1) * rowsPerPage;
            return items.slice(startIndex, startIndex + rowsPerPage);
        }

        function generatePaginationButtons(totalItems) {
            const totalPages = Math.ceil(totalItems / rowsPerPage);
            let buttonsHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                buttonsHTML += `<button class="px-3 py-1 ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} rounded-lg" onclick="changePage(${i})">${i}</button>`;
            }

            return buttonsHTML;
        }

        function changePage(page) {
            currentPage = page;
            filterFaqs();
        }

        function showDetails(id) {
            // Request detail data dengan AJAX
            fetch(`/faq/${id}`)
                .then(response => response.json())
                .then(data => {
                    let deskripsiHTML = '';

                    if (Array.isArray(data.deskripsi_penyelesaian_masalah)) {
                        deskripsiHTML = '<div class="space-y-2">';
                        data.deskripsi_penyelesaian_masalah.forEach((item) => {
                            deskripsiHTML += `<p>${item}</p>`;
                        });
                        deskripsiHTML += '</div>';
                    } else {
                        const deskripsiItems = data.deskripsi_penyelesaian_masalah.split('\n');
                        deskripsiHTML = '<div class="space-y-2">';
                        deskripsiItems.forEach((item) => {
                            deskripsiHTML += `<p>${item.trim()}</p>`;
                        });
                        deskripsiHTML += '</div>';
                    }

                    document.getElementById('modalContent').innerHTML = `
                    <p class="mb-2"><strong>ID:</strong> ${data.id}</p>
                    <p class="mb-2"><strong>Nama Masalah:</strong> ${data.nama_masalah}</p>
                    <p class="mb-2"><strong>Bidang Permasalahan:</strong> ${data.bidang_permasalahan}</p>
                    <p class="mb-2"><strong>Deskripsi Penyelesaian Masalah:</strong></p>
                    <div class="whitespace-pre-wrap break-words">${deskripsiHTML}</div>
                    `;
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
@endsection
