@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-left text-xl font-semibold">Daftar Barang</h2>
            <div class="flex justify-end mb-4">
                <a href="{{ route('tambah-pengadaan') }}"
                    class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Tambah Barang
                </a>
            </div>
        </div>
        <hr class="mb-6">

        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Kode Barang</th>
                        <th class="px-4 py-2 border">Nama Barang</th>
                        <th class="px-4 py-2 border">Merek</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2 border">{{ $item->kd_barang }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama_barang }}</td>
                            <td class="px-4 py-2 border">{{ $item->merek }}</td>
                            <td class="px-4 py-2 border">
                                {{ $item->kategori ? $item->kategori->nama_kategori : 'Kategori tidak ditemukan' }}</td>
                            <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
                            <td class="px-4 py-2 border">
                                <a href="#" class="text-blue-500 hover:underline"
                                    onclick="showImage('{{ asset('storage/fotos/' . $item->foto) }}')">{{ $item->foto }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-4xl w-full">
            <img id="modalImage" src="" alt="Foto Barang" class="mx-auto max-w-full h-auto"
                style="max-height: 70vh;">
            <div class="mt-4 text-right">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function showImage(imagePath) {
            document.getElementById('modalImage').src = imagePath;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
@endsection
