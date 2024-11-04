@extends('layouts.homedash')

@section('content')

    <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
        <div class="flex justify-between items-center mb-4 ">
            <h2 class="text-left text-xl font-semibold">Data Transaksi</h2>
            <a href="{{ route('generate-pdf') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Generate PDF
            </a>
            <a href="{{ route('tambah-pengadaan') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Tambah
            </a>
           

        </div>
        <hr class="mb-6">

        <!-- Tabel Transaksi -->
        <div class="overflow-x-auto">
            <form method="GET" action="{{ route('pengadaan') }}" class="mb-4">
                <div class="flex items-center space-x-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan kode transaksi atau nama barang"
                        class="px-4 py-2 border rounded w-full" />
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Cari
                    </button>
                    <a href="{{ route('pengadaan') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Kode Transaksi</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Tanggal Transaksi</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Keterangan</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Barang</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Nota</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-600 uppercase">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $item->kd_transaksi }}</td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $item->tgl_transaksi }}</td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $item->keterangan }}</td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $item->nama_barang }}</td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                @if ($item->nota)
                                    <a href="javascript:void(0)" class="text-blue-500 hover:underline"
                                        onclick="showNota('{{ asset('storage/fotos/' . $item->nota) }}')">{{ basename($item->nota) }}</a>
                                @else
                                    <span class="text-gray-500">Transaksi tidak terdapat nota</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                <button onclick="showDetail({{ json_encode($item) }})"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Detail</button>
                                <form action="{{ route('transaksi.destroy', $item->kd_transaksi) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Pop-up Box for Detail -->
        <div id="detailModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
                <h3 class="text-xl font-semibold mb-4">Detail Transaksi</h3>
                <p><strong>Kode Transaksi:</strong> <span id="detailKodeTransaksi"></span></p>
                <p><strong>Tanggal Transaksi:</strong> <span id="detailTanggalTransaksi"></span></p>
                <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>
                <p><strong>Nama Barang:</strong> <span id="detailNamaBarang"></span></p>
                <p><strong>Nota:</strong> <span id="detailNota"></span></p>
                <img id="detailNotaImage" src="" alt="Nota" class="w-full h-auto mb-4"
                    style="max-width: 90vw; max-height: 80vh;">
                <button onclick="closeDetail()" class="bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>

        <script>
            function showDetail(item) {
                document.getElementById('detailKodeTransaksi').innerText = item.kd_transaksi;
                document.getElementById('detailTanggalTransaksi').innerText = item.tgl_transaksi;
                document.getElementById('detailKeterangan').innerText = item.keterangan;
                document.getElementById('detailNamaBarang').innerText = item.nama_barang;

                if (item.nota) {
                    document.getElementById('detailNotaImage').src = `/storage/fotos/${item.nota}`;
                    document.getElementById('detailNotaImage').classList.remove('hidden');
                } else {
                    document.getElementById('detailNotaImage').classList.add('hidden');
                }

                document.getElementById('detailModal').classList.remove('hidden');
            }

            function closeDetail() {
                document.getElementById('detailModal').classList.add('hidden');
            }
        </script>
    </div>

@endsection
