@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4 ">
        <h2 class="text-left text-xl font-semibold">Daftar Barang</h2>
        <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
            Tambah Barang
        </a>
    </div>
    <hr class="mb-6">
    
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Id</th>
                    <th class="px-4 py-2 border">Kode Barang</th>
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Merek</th>
                    <th class="px-4 py-2 border">Kode Kategori</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr class="bg-white border-b">
                    <td class="px-4 py-2 border">{{ $item->id }}</td>
                    <td class="px-4 py-2 border">{{ $item->kd_barang }}</td>
                    <td class="px-4 py-2 border">{{ $item->nama_barang }}</td>
                    <td class="px-4 py-2 border">{{ $item->merek }}</td>
                    <td class="px-4 py-2 border">{{ $item->kd_kategori }}</td>
                    <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
                    <td class="px-4 py-2 border">
                        <a href="#" class="text-blue-500 hover:underline" onclick="showImage('{{ asset($item->foto) }}')">{{ $item->foto }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pop-up untuk menampilkan gambar -->
<div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-50">
    <div class="bg-white p-4 rounded-lg shadow-lg relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage" src="" alt="Foto Barang" class="max-w-full h-auto">
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
