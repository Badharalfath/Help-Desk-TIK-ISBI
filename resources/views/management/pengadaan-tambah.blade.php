@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-6">
        <h3 class="text-lg font-semibold">TRANSAKSI PENGADAAN</h3>
        <div class="bg-white rounded-lg shadow-md p-6">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4">
                <h5 class="text-lg font-medium">DATA TRANSAKSI</h5>
            </div>
            <form id="pengadaanForm" method="POST" action="{{ route('pengadaan.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Tanggal Pengadaan -->
                <div class="mb-4">
                    <label for="tanggal_pengadaan" class="block text-gray-700">Tgl. Pengadaan</label>
                    <input type="date" class="w-full px-4 py-2 border rounded-lg" id="tanggal_pengadaan"
                        name="tgl_pengadaan" required>

                </div>

                <!-- Supplier -->
                <div class="mb-4">
                    <label for="supplier" class="block text-gray-700">Supplier (Asal Barang)</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg" id="supplier" name="supplier"
                        required>
                </div>

                <!-- Keterangan -->
                <div class="mb-4">
                    <label for="keterangan" class="block text-gray-700">Keterangan</label>
                    <textarea class="w-full px-4 py-2 border rounded-lg" id="keterangan" name="keterangan"></textarea>
                </div>

                <!-- Upload Nota -->
                <div class="mb-4">
                    <label for="nota" class="block text-gray-700">Kwitansi / Nota</label>
                    <input type="file" class="w-full px-4 py-2 border rounded-lg" id="nota" name="nota">
                </div>

                <!-- Section for Input Barang -->
                <div class="bg-gray-100 p-4 mt-6 rounded-lg shadow">
                    <h5 class="text-lg font-medium mb-4">INPUT BARANG</h5>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="kategori" class="block text-gray-700">Kategori</label>
                        <select name="kategori[]" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->kd_kategori }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg" id="nama_barang"
                            name="nama_barang[]" required>
                    </div>

                    <!-- Merek Barang -->
                    <div class="mb-4">
                        <label for="merek" class="block text-gray-700">Merek Barang</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg" id="merek" name="merek[]"
                            required>
                    </div>

                    <!-- Harga Unit -->
                    <div class="mb-4">
                        <label for="harga_unit" class="block text-gray-700">Harga Unit Barang / Beli (Rp.)</label>
                        <div class="flex items-center space-x-4">
                            <input type="number" class="w-full px-4 py-2 border rounded-lg" id="harga_unit"
                                name="harga_unit[]" required>
                            <span class="ml-4" id="total_harga">Total Harga: Rp. 0</span>
                        </div>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-gray-700">Jumlah</label>
                        <input type="number" class="w-full px-4 py-2 border rounded-lg" id="jumlah" name="jumlah[]"
                            value="1" min="1">
                    </div>

                    <!-- Foto Barang -->
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700">Foto Barang</label>
                        <input type="file" class="w-full px-4 py-2 border rounded-lg" id="foto" name="foto[]">
                    </div>

                    <!-- Button Tambah ke Preview -->
                    <div class="text-right">
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg" id="tambahBarang">Tambah
                            ke Preview</button>
                    </div>
                </div>

                <!-- Preview Table -->
                <div class="bg-gray-100 p-4 mt-6 rounded-lg shadow">
                    <h5 class="text-lg font-medium mb-4">DAFTAR BARANG (PREVIEW)</h5>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b p-2">No</th>
                                <th class="border-b p-2">Kode Barang</th>
                                <th class="border-b p-2">Deskripsi</th>
                                <th class="border-b p-2">Merek</th>
                                <th class="border-b p-2">Harga (Rp.)</th>
                                <th class="border-b p-2">Jumlah</th>
                                <th class="border-b p-2">Total Biaya (Rp.)</th>
                                <th class="border-b p-2">Tools</th>
                            </tr>
                        </thead>
                        <tbody id="previewTable">
                            <!-- Data barang yang diinput akan ditampilkan di sini -->
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <label for="grand_total" class="block text-gray-700">GRAND TOTAL</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg" id="grand_total"
                            name="grand_total" readonly value="0">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg">SUBMIT DATA KE
                        DATABASE</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let kodeBarangCounter = {{ $last_kd_barang + 1 }};

        // Display total cost beside harga_barang
        document.getElementById('harga_unit').addEventListener('input', updateTotalHarga);
        document.getElementById('jumlah').addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const harga = parseFloat(document.getElementById('harga_unit').value) || 0;
            const jumlah = parseInt(document.getElementById('jumlah').value) || 1;
            const total = harga * jumlah;
            document.getElementById('total_harga').innerText = 'Total Harga: Rp. ' + total.toLocaleString();
        }

        // Add item to preview table
        document.getElementById('tambahBarang').addEventListener('click', function() {
            const kategori = document.getElementById('kategori').value;
            const nama_barang = document.getElementById('nama_barang').value;
            const merek = document.getElementById('merek').value;
            const harga_barang = parseFloat(document.getElementById('harga_unit').value);
            const jumlah = parseInt(document.getElementById('jumlah').value);

            // Cek kelengkapan input sebelum ditambahkan ke tabel preview
            if (!kategori || !nama_barang || !merek || !harga_unit || !jumlah) {
                alert('Lengkapi semua data barang sebelum menambahkan ke tabel!');
                return; // Stop jika form belum lengkap
            }

            // Jika form lengkap, tambahkan ke tabel preview
            const total = harga_unit * jumlah;

            const table = document.getElementById('previewTable');
            const row = table.insertRow();
            const no = table.rows.length;
            const kode_barang = 'B' + kodeBarangCounter.toString().padStart(3, '0'); // Format B001, B002, ...

            row.innerHTML = `
        <td>${no}</td>
        <td>${kode_barang}</td>
        <td>${nama_barang}</td>
        <td>${merek}</td>
        <td>${harga_unit.toLocaleString()}</td>
        <td>${jumlah}</td>
        <td>${total.toLocaleString()}</td>
        <td><button type="button" class="bg-red-500 text-white px-2 py-1 rounded-lg" onclick="hapusBarang(this, ${total})">Hapus</button></td>
    `;

            kodeBarangCounter++;

            // Update Grand Total
            let grandTotal = parseFloat(document.getElementById('grand_total').value.replace(/,/g, '')) || 0;
            grandTotal += total;
            document.getElementById('grand_total').value = grandTotal.toLocaleString();
        });


        // Function to delete a row and update grand total
        function hapusBarang(btn, total) {
            const row = btn.closest('tr');
            row.remove();

            let grandTotal = parseFloat(document.getElementById('grand_total').value.replace(/,/g, '')) || 0;
            grandTotal -= total;
            document.getElementById('grand_total').value = grandTotal.toLocaleString();
        }
    </script>
@endsection
