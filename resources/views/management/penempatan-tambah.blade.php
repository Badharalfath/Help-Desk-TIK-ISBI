@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Penggunaan Barang</h2>
        <hr class="mb-4">

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- penempatan-tambah.blade.php -->
        <form method="POST" action="{{ route('penempatan.store') }}"
            enctype="multipart/form-data"class="max-w-lg mx-auto p-4">
            @csrf

            <!-- No. Penempatan (Otomatis) -->
            <input type="hidden" id="kd_penempatan" name="kd_penempatan" value="{{ $newKdPenempatan }}">

            <!-- Nama Barang -->
            <div class="mb-4 relative">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <select id="nama_barang"
                    class="searchable-dropdown mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="#" disabled selected>-- Pilih Nama Barang --</option>
                    @foreach ($barang as $brg)
                        <option value="{{ $brg->kd_barang }}">{{ $brg->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input Hidden untuk Kode Barang -->
            <input type="hidden" id="kd_barang" name="kd_barang">
            <!-- Input Hidden untuk Nama Barang -->
            <input type="hidden" id="nama_barang_hidden" name="nama_barang">

            <!-- Jumlah Barang -->
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
                <input type="number" id="jumlah" name="jumlah"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" min="1" required>
                <small id="stock-info" class="text-red-500"></small>
            </div>

            <!-- Departemen -->
            <div class="mb-4">
                <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                <select id="departemen" name="kd_departemen" {{-- Pastikan name sesuai --}}
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach ($departemen as $dept)
                        <option value="{{ $dept->kd_departemen }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <select id="lokasi" name="kd_lokasi" {{-- Pastikan name sesuai --}}
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Lokasi --</option>
                    {{-- Lokasi akan dimuat berdasarkan departemen yang dipilih --}}
                </select>
            </div>


            <!-- Tanggal Penempatan -->
            <div class="mb-4">
                <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penggunaan</label>
                <input type="date" id="tgl_penempatan" name="tgl_penempatan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <!-- Keterangan -->
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700 font-bold mb-2">Upload Foto</label>
                <input type="file" name="foto[]" id="foto" multiple
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>

        <!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Select2 untuk dropdown searchable
        $('#nama_barang').select2({
            placeholder: "Pilih Nama Barang",
            allowClear: true,
            width: '100%'
        });

        // Auto-fill kd_barang dan nama_barang_hidden when selecting nama_barang
        $('#nama_barang').on('select2:select', function (e) {
            const selectedOption = e.params.data;
            const namaBarang = selectedOption.text; // Teks nama barang
            const kdBarang = selectedOption.id; // Value kode barang

            document.getElementById('kd_barang').value = kdBarang; // Set hidden field kd_barang
            document.getElementById('nama_barang_hidden').value = namaBarang; // Set hidden field nama_barang
        });

        // Clear selection functionality
        $('#nama_barang').on('select2:clear', function () {
            document.getElementById('kd_barang').value = ''; // Clear kd_barang hidden field
            document.getElementById('nama_barang_hidden').value = ''; // Clear nama_barang hidden field
        });

        // Departemen dan lokasi handling
        const departemenDropdown = document.getElementById('departemen');
        const lokasiDropdown = document.getElementById('lokasi');

        departemenDropdown.addEventListener('change', function () {
            const departemenId = this.value;

            lokasiDropdown.innerHTML = '<option value="">-- Pilih Lokasi --</option>'; // Reset dropdown

            if (departemenId) {
                fetch(`/get-lokasi/${departemenId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        data.forEach(function (lokasi) {
                            lokasiDropdown.innerHTML += `<option value="${lokasi.kd_lokasi}">${lokasi.nama_lokasi}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat lokasi.');
                    });
            }
        });
    });
</script>
    </div>
@endsection
