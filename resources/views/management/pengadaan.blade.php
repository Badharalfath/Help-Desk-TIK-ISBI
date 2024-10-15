@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
        <div class="flex justify-between items-center mb-4 ">
            <h2 class="text-left text-xl font-semibold">Data Transaksi</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('tambah-pengadaan') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah</a>
            </div>
        </div>
        <hr class="mb-6">

        <!-- Tabel Transaksi -->
        <div class="overflow-x-auto">
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
                                        onclick="showNota('{{ asset('storage/' . $item->nota) }}')">{{ basename($item->nota) }}</a>
                                @else
                                    <span class="text-gray-500">Transaksi tidak terdapat nota</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                <form action="{{ route('transaksi.destroy', $item->kd_transaksi) }}" method="POST" class="inline-block">
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

        <!-- Modal Pop-up Box -->
        <div id="notaModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
                <h3 class="text-xl font-semibold mb-4">Nota</h3>
                <img id="notaImage" src="" alt="Nota" class="w-full h-auto mb-4">
                <button onclick="closeNota()" class="bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function showNota(notaUrl) {
            document.getElementById('notaImage').src = notaUrl;
            document.getElementById('notaModal').classList.remove('hidden');
        }

        function closeNota() {
            document.getElementById('notaModal').classList.add('hidden');
        }
    </script>
@endsection
