@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h2 class="text-left text-xl font-semibold mb-2 mt-5">Tambah Penempatan Barang</h2>
        <hr class="mb-4">

        <!-- penempatan-tambah.blade.php -->
        <form action="{{ route('penempatan.store') }}" method="POST" class="max-w-lg mx-auto p-4">
            @csrf

            <!-- No. Penempatan (Otomatis) -->
            <div class="mb-4">
                <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penempatan</label>
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
                <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penempatan</label>
                <input type="date" id="tgl_penempatan" name="tgl_penempatan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <!-- Keterangan -->
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
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

            document.addEventListener('DOMContentLoaded', function() {
                const barangData = @json($barang); // Mengambil data barang dari controller

                const kodeBarangDropdown = document.getElementById('kd_barang');
                const namaBarangDropdown = document.getElementById('nama_barang');

                // Ketika Kode Barang dipilih
                kodeBarangDropdown.addEventListener('change', function() {
                    const selectedKode = kodeBarangDropdown.value;

                    if (selectedKode) {
                        // Temukan barang berdasarkan kode
                        const barang = barangData.find(item => item.kd_barang === selectedKode);
                        if (barang) {
                            // Set nama barang yang sesuai
                            namaBarangDropdown.value = barang.nama_barang;
                        }
                    } else {
                        namaBarangDropdown.value = ''; // Kosongkan jika tidak ada yang dipilih
                    }
                });

                // Ketika Nama Barang dipilih
                namaBarangDropdown.addEventListener('change', function() {
                    const selectedNama = namaBarangDropdown.value;

                    if (selectedNama) {
                        // Temukan barang berdasarkan nama
                        const barang = barangData.find(item => item.nama_barang === selectedNama);
                        if (barang) {
                            // Set kode barang yang sesuai
                            kodeBarangDropdown.value = barang.kd_barang;
                        }
                    } else {
                        kodeBarangDropdown.value = ''; // Kosongkan jika tidak ada yang dipilih
                    }
                });
            });
        </script>


    </div>
@endsection
