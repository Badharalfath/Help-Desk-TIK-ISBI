@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-left text-xl font-semibold">Daftar FAQ</h2>

        <!-- Search Form -->
        <form action="{{ route('faq.menu') }}" method="GET" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Masalah..."
                    class="px-4 py-2 border rounded w-full" />
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Cari
                </button>
                <a href="{{ route('faq.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>

        <div class="flex justify-end mb-4">
            <a href="{{ route('formfaq.index') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Input FAQ
            </a>
        </div>
    </div>

    <hr class="mb-6">

    <!-- Notification for success -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Dropdown for category selection -->
    <div class="flex justify-between mb-4">
        <select id="faqCategoryDropdown"
            class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-1/3 p-2"
            onchange="filterFaqs()">
            <option value="all">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->bidang_permasalahan }}">{{ ucfirst($category->bidang_permasalahan) }}</option>
            @endforeach
        </select>
    </div>

    <!-- FAQ table -->
    <div id="faqContainer">
        <!-- The table will be populated dynamically using JavaScript based on the selected category -->
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-5 rounded shadow-lg w-4/5 h-4/5 overflow-y-auto relative">
            <h3 class="text-lg font-bold mb-4 mt-10">Detail Masalah</h3>
            <div id="modalContent"></div>
            <button class="absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"
                onclick="closeModal()">Tutup</button>
        </div>
    </div>

</div>

<script>
    let allFaqs = @json($allFaqs); // Data of all FAQs
    let currentSortField = null;
    let currentSortDirection = 'asc';
    let currentPage = 1;
    const rowsPerPage = 5;

    document.addEventListener("DOMContentLoaded", function() {
        filterFaqs(); // Default tampilkan kategori pertama
    });

    // Function to filter FAQs by category and paginate
    function filterFaqs(resetPage = true) {
        const category = document.getElementById('faqCategoryDropdown').value;

        // Reset to page 1 when category changes
        if (resetPage) {
            currentPage = 1;
        }

        let faqs = category === 'all' ? allFaqs : allFaqs.filter(faq => faq.bidang_permasalahan === category);

        displayFaqTable(faqs);
    }

    // Function to display paginated table of FAQs
    function displayFaqTable(faqs) {
        const faqContainer = document.getElementById('faqContainer');
        const paginatedFaqs = paginate(faqs, currentPage, rowsPerPage);

        let tableHTML = `
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Nama Masalah</th>
                    <th class="py-2 px-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>`;

        paginatedFaqs.forEach(faq => {
            tableHTML += `
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-sm text-gray-600">${faq.id}</td>
                <td class="py-2 px-4 border-b text-sm text-gray-600">${faq.nama_masalah}</td>
                <td class="py-2 px-4 border-b text-right">
                    <div class="flex justify-end space-x-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded" onclick="showDetails(${faq.id})">Detail</button>
                        <a href="/faq/${faq.id}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Edit</a>
                        <form action="/faq/${faq.id}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>`;
        });

        tableHTML += `</tbody></table>`;

        // Pagination buttons
        tableHTML += `<div class="mt-4 flex justify-center space-x-2">${generatePaginationButtons(faqs.length)}</div>`;

        faqContainer.innerHTML = tableHTML;
    }

    // Function to handle pagination logic
    function paginate(items, currentPage, rowsPerPage) {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        return items.slice(startIndex, endIndex);
    }

    // Function to generate pagination buttons
    function generatePaginationButtons(totalItems) {
        const totalPages = Math.ceil(totalItems / rowsPerPage);
        let buttonsHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            buttonsHTML +=
                `<button class="px-3 py-1 ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} rounded-lg" onclick="changePage(${i})">${i}</button>`;
        }

        return buttonsHTML;
    }

    // Function to change the page
    function changePage(page) {
        currentPage = page;
        filterFaqs(false); // Don't reset to page 1 when changing pages
    }

    // Function to show details (example with AJAX fetching data)
    function showDetails(id) {
        fetch(`/faq/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalContent').innerHTML = `
                <p><strong>ID:</strong> ${data.id}</p>
                <p><strong>Nama Masalah:</strong> ${data.nama_masalah}</p>
                <p><strong>Bidang Permasalahan:</strong> ${data.bidang_permasalahan}</p>
                <p><strong>Deskripsi:</strong> ${data.deskripsi_penyelesaian_masalah}</p>`;
                document.getElementById('detailModal').classList.remove('hidden');
            });
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection
