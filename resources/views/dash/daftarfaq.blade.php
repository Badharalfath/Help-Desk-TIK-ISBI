@extends('layouts.homedash')

@section('content')

    <head>
        <!-- Tambahkan Tailwind CSS dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Daftar FAQ</h1>
        <a href="{{ route('formfaq.index') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
            Tambah FAQ
        </a>
    </div>

    <div class="flex">
        <!-- Tabel untuk bidang_permasalahan = it -->
        <div class="w-1/2 mr-4 bg-white shadow-md rounded">
            <!-- Judul di luar tabel -->
            <div class="px-4 py-2 bg-gray-100 rounded-t">
                <h2 class="text-lg font-bold">Binus dan Comtronics</h2>
            </div>
            <!-- Tabel FAQ IT -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">ID</th>
                        <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">Nama Masalah
                        </th>
                        <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itFaqs as $index => $faq)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->id }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-600">{{ $faq->nama_masalah }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-600">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded"
                                    onclick="showDetails({{ $faq->id }})">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel untuk bidang_permasalahan = apps -->
        <div class="w-1/2 bg-white shadow-md rounded">
            <!-- Judul di luar tabel -->
            <div class="px-4 py-2 bg-gray-100 rounded-t">
                <h2 class="text-lg font-bold">Aplikasi dan Email</h2>
            </div>
            <!-- Tabel FAQ Apps -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">ID</th>
                        <th class="py-2 px-4 border-b bg-gray-100 text-left text-sm font-bold text-gray-700">Nama Masalah
                        </th>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal untuk detail -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-5 rounded shadow-lg w-4/5 h-4/5 overflow-y-auto relative">
            <h3 class="text-lg font-bold mb-4">Detail Masalah</h3>
            <div id="modalContent"></div> <!-- Konten data lengkap akan muncul di sini -->
            <button class="absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"
                onclick="closeModal()">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function showDetails(id) {
            // Request detail data dengan AJAX
            fetch(`/faq/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Tampilkan seluruh data di modal dengan format yang lebih terstruktur
                    document.getElementById('modalContent').innerHTML = `
                    <p><strong>Nama Masalah:</strong></p>
                    <p>${data.nama_masalah}</p>
                    
                    <p><strong>Bidang Permasalahan:</strong></p>
                    <p>${data.bidang_permasalahan}</p>

                    <p><strong>Deskripsi Penyelesaian Masalah:</strong></p>
                    <p>${data.deskripsi_penyelesaian_masalah}</p>
                `;
                    document.getElementById('detailModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>

<script>
    function showDetails(id) {
        // Request detail data dengan AJAX
        fetch(`/faq/${id}`)
            .then(response => response.json())
            .then(data => {
                // Proses deskripsi jika dalam bentuk JSON array atau dipisahkan dengan newline
                let deskripsiHTML = '';

                // Cek jika deskripsi disimpan dalam format JSON array
                if (Array.isArray(data.deskripsi_penyelesaian_masalah)) {
                    deskripsiHTML = '<ol>';
                    data.deskripsi_penyelesaian_masalah.forEach((item) => {
                        deskripsiHTML += `<li>${item}</li>`;
                    });
                    deskripsiHTML += '</ol>';
                } else {
                    // Jika deskripsi dipisahkan oleh newline (\n)
                    const deskripsiItems = data.deskripsi_penyelesaian_masalah.split('\n');
                    deskripsiHTML = '<ol>';
                    deskripsiItems.forEach((item) => {
                        deskripsiHTML += `<li>${item.trim()}</li>`;
                    });
                    deskripsiHTML += '</ol>';
                }

                // Tampilkan seluruh data di modal
                document.getElementById('modalContent').innerHTML = `
                    <p><strong>ID:</strong> ${data.id}</p>
                    <p><strong>Nama Masalah:</strong> ${data.nama_masalah}</p>
                    <p><strong>Bidang Permasalahan:</strong> ${data.bidang_permasalahan}</p>
                    <p><strong>Deskripsi Penyelesaian Masalah:</strong> ${deskripsiHTML}</p>
                `;
                // Tampilkan modal
                document.getElementById('detailModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>


@endsection
