@extends('layouts.homedash')

@section('content')
    <div class="overflow-x-auto mt-3 py-6 px-16">
        <h2 class="text-2xl font-bold mb-[-45px]">Daftar Pengguna</h2>
        
        <div class=" flex justify-end mb-4">
            <a href="{{ route('formfaq.index') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Tambah FAQ
            </a>
        </div>



        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.935 2.935a1 1 0 1 1-1.414-1.414l3.25-3.25a1 1 0 0 1 1.414 0l3.25 3.25a1 1 0 0 1 0 1.414z" />
                    </svg>
                </span>
            </div>
        @endif

        <div class="flex space-x-4">
            <!-- Wrapper untuk tabel bidang_permasalahan = it -->
            <div class="w-1/2 bg-white shadow-md rounded flex-grow-0">
                <!-- Judul di luar tabel -->
                <div class="px-4 py-2 bg-gray-100 rounded-t">
                    <h2 class="text-lg font-bold">Internet dan Jaringan</h2>
                </div>
                <!-- Wrapper untuk tabel dengan tinggi tetap dan scroll -->
                <div class="max-h-[400px] overflow-auto">
                    <!-- Tabel FAQ IT -->
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">ID</th>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">Nama
                                    Masalah</th>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itFaqs as $index => $faq)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->id }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->nama_masalah }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">
                                        <!-- Detail Button -->
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded"
                                            onclick="showDetails({{ $faq->id }})">Detail</button>

                                        <!-- Edit Button -->
                                        <a href="{{ route('faq.edit', $faq->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded transition duration-300 ease-in-out mx-1">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('faq.destroy', $faq->id) }}" method="POST"
                                            class="inline mx-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-400 hover:bg-red-800 text-white py-1 px-3 rounded transition duration-300 ease-in-out"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Wrapper untuk tabel bidang_permasalahan = apps -->
            <div class="w-1/2 bg-white shadow-md rounded flex-grow-0">
                <!-- Judul di luar tabel -->
                <div class="px-4 py-2 bg-gray-100 rounded-t">
                    <h2 class="text-lg font-bold">Aplikasi dan Email</h2>
                </div>
                <!-- Wrapper untuk tabel dengan tinggi tetap dan scroll -->
                <div class="max-h-[400px] overflow-auto">
                    <!-- Tabel FAQ Apps -->
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">ID</th>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">Nama
                                    Masalah</th>
                                <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appsFaqs as $index => $faq)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->id }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->nama_masalah }}</td>
                                    <td class="py-2 px-4 border-b text-sm text-gray-600">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded"
                                            onclick="showDetails({{ $faq->id }})">Detail</button>
                                        <a href="{{ route('faq.edit', $faq->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">Edit</a>
                                        <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal untuk detail -->
        <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-5 rounded shadow-lg w-4/5 h-4/5 overflow-y-auto relative">
                <h3 class="text-lg font-bold mb-4">Detail Masalah</h3>
                <div id="modalContent"></div> <!-- Konten data lengkap akan muncul di sini -->
                <button class="absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"
                    onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>
    <script>
        function showDetails(id) {
            // Request detail data dengan AJAX
            fetch(`/faq/${id}`)
                .then(response => response.json())
                .then(data => {
                    let deskripsiHTML = '';

                    // Cek jika deskripsi disimpan dalam format JSON array
                    if (Array.isArray(data.deskripsi_penyelesaian_masalah)) {
                        deskripsiHTML = '<div class="space-y-2">'; // Gunakan div dengan margin antara item
                        data.deskripsi_penyelesaian_masalah.forEach((item) => {
                            deskripsiHTML += `<p>${item}</p>`;
                        });
                        deskripsiHTML += '</div>';
                    } else {
                        // Jika deskripsi dipisahkan oleh newline (\n)
                        const deskripsiItems = data.deskripsi_penyelesaian_masalah.split('\n');
                        deskripsiHTML = '<div class="space-y-2">'; // Gunakan div dengan margin antara item
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
