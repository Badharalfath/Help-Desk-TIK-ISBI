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
        <form action="{{ route('penempatan.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto p-4">
            @csrf

            <!-- No. Penempatan (Otomatis) -->
            <div class="mb-4">
                <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penggunaan</label>
                <input type="text" id="kd_penempatan" name="kd_penempatan" value="{{ $newKdPenempatan }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
            </div>

            <div class="mb-4">
                <label for="kd_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                <select id="kd_barang" name="kd_barang"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Kode Barang --</option>
                    @foreach ($barang as $brg)
                        <option value="{{ $brg->kd_barang }}">{{ $brg->kd_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <select id="nama_barang" name="nama_barang"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Nama Barang --</option>
                    @foreach ($barang as $brg)
                        <option value="{{ $brg->nama_barang }}">{{ $brg->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah Barang -->
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
                <input type="number" id="jumlah" name="jumlah" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" min="1" required>
                <small id="stock-info" class="text-red-500"></small>
            </div>

            <div class="mb-4">
                <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
                <select id="departemen" name="departemen"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach ($departemen as $dept)
                        <option value="{{ $dept->kode }}">{{ $dept->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <select id="lokasi" name="lokasi"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($lokasi as $loc)
                        <option value="{{ $loc->kode }}">{{ $loc->nama_lokasi }}</option>
                    @endforeach
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

            <!-- Input for Multiple Foto -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-700 font-bold mb-2">Upload Foto Barang</label>
                <input type="file" name="foto[]" id="foto" multiple
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </form>

        <!-- AJAX untuk Memuat Lokasi Berdasarkan Departemen -->
        <script>
            document.getElementById('departemen').addEventListener('change', function() {
                let departemenId = this.value;
                let lokasiDropdown = document.getElementById('lokasi');

                // Kosongkan dropdown lokasi sebelum mengisi
                lokasiDropdown.innerHTML = '<option value="">Pilih Lokasi</option>';

                // Jika ada departemen yang dipilih
                if (departemenId) {
                    fetch(`/get-lokasi/${departemenId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function(lokasi) {
                                lokasiDropdown.innerHTML +=
                                    `<option value="${lokasi.kode}">${lokasi.nama_lokasi}</option>`;
                            });
                        });
                }
            });

            document.addEventListener('DOMContentLoaded', function () {
        const barangData = @json($barang); // Load barang data from the server

        const kodeBarangDropdown = document.getElementById('kd_barang');
        const namaBarangDropdown = document.getElementById('nama_barang');
        const jumlahInput = document.getElementById('jumlah');
        const stockInfo = document.getElementById('stock-info');

        // Function to update the stock info and set max quantity
        function updateStockInfo() {
            const selectedOption = kodeBarangDropdown.options[kodeBarangDropdown.selectedIndex];
            const stock = selectedOption.getAttribute('data-stock');
            if (stock) {
                stockInfo.textContent = `Stok Tersedia: ${stock}`;
                jumlahInput.max = stock;
            } else {
                stockInfo.textContent = '';
                jumlahInput.max = '';
            }
        }

        // Event listener for when "Kode Barang" is selected
        kodeBarangDropdown.addEventListener('change', function () {
            const selectedKode = kodeBarangDropdown.value;

            if (selectedKode) {
                const barang = barangData.find(item => item.kd_barang === selectedKode);
                if (barang) {
                    // Automatically select the corresponding "Nama Barang"
                    namaBarangDropdown.value = barang.nama_barang;
                    updateStockInfo(); // Update stock info based on the selected kode barang
                }
            } else {
                namaBarangDropdown.value = ''; // Clear the "Nama Barang" field if no kode selected
                stockInfo.textContent = '';
            }
        });

        // Event listener for when "Nama Barang" is selected
        namaBarangDropdown.addEventListener('change', function () {
            const selectedNama = namaBarangDropdown.value;

            if (selectedNama) {
                const barang = barangData.find(item => item.nama_barang === selectedNama);
                if (barang) {
                    // Automatically select the corresponding "Kode Barang"
                    kodeBarangDropdown.value = barang.kd_barang;
                    updateStockInfo(); // Update stock info based on the selected nama barang
                }
            } else {
                kodeBarangDropdown.value = ''; // Clear the "Kode Barang" field if no nama selected
                stockInfo.textContent = '';
            }
        });

        // Initialize stock info if a "Kode Barang" is pre-selected (e.g., on form reload)
        updateStockInfo();
    });
        </script>


    </div>
@endsection
