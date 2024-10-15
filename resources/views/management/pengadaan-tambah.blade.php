@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto p-6">
        
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
            <form id="transaksiForm" method="POST" action="{{ route('pengadaan.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Tanggal Transaksi -->
                <div class="mb-4">
                    <label for="tgl_transaksi" class="block text-gray-700">Tgl. Transaksi</label>
                    <input type="date" class="w-full px-4 py-2 border rounded-lg" id="tgl_transaksi"
                        name="tgl_transaksi" required>
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
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg">SUBMIT DATA KE
                        DATABASE</button>
                </div>
            </form>
        </div>
    </div>
@endsection
