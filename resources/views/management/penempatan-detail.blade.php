<div class="container mx-auto">
    <form action="{{ route('penempatan.update', $penempatan->kd_penempatan) }}" method="POST" class="max-w-lg mx-auto">
        @csrf
        @method('PUT')

        <!-- No. Penempatan (Readonly) -->
        <div class="mb-4">
            <label for="kd_penempatan" class="block text-sm font-medium text-gray-700">No. Penggunaan</label>
            <input type="text" id="kd_penempatan" name="kd_penempatan" value="{{ $penempatan->kd_penempatan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Kode Barang (Readonly) -->
        <div class="mb-4">
            <label for="kd_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
            <input type="text" id="kd_barang" name="kd_barang" value="{{ $penempatan->kd_barang }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Nama Barang (Readonly) -->
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $penempatan->nama_barang }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Nama Departemen -->
        <div class="mb-4">
            <label for="departemen" class="block text-sm font-medium text-gray-700">Departemen</label>
            <input type="text" id="departemen" name="departemen" value="{{ $penempatan->departemen->nama_departemen ?? 'Tidak Ditemukan' }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Lokasi -->
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ $penempatan->lokasi->nama_lokasi ?? 'Tidak Ditemukan' }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Tanggal Penempatan -->
        <div class="mb-4">
            <label for="tgl_penempatan" class="block text-sm font-medium text-gray-700">Tanggal Penggunaan</label>
            <input type="date" id="tgl_penempatan" name="tgl_penempatan" value="{{ $penempatan->tgl_penempatan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Keterangan -->
        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" value="{{ $penempatan->keterangan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
        </div>

        <!-- Section for Displaying All Images -->
        <label for="foto_penempatan" class="block text-sm font-medium text-gray-700">Gambar Penggunaan</label>
        <div class="mt-2 p-2 border rounded-lg shadow-md bg-white">
            @php
                $fotoPenempatanArray = $penempatan->foto_penempatan ? explode(',', $penempatan->foto_penempatan) : [];
            @endphp

            @if (!empty($fotoPenempatanArray))
                <!-- Loop through each image and display them -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($fotoPenempatanArray as $foto)
                        <div class="w-full">
                            <img src="{{ Storage::url('fotos/' . $foto) }}" alt="Foto Penempatan" class="w-full h-auto object-cover"
                                onerror="this.onerror=null; this.src='{{ asset('images/default-placeholder.png') }}'">
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Placeholder if no images available -->
                <img src="{{ asset('images/default-placeholder.png') }}" alt="Foto Penempatan" class="w-full h-auto max-w-md mx-auto">
            @endif
        </div>
    </form>
</div>
