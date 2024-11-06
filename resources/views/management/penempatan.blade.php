@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-left text-xl font-semibold">Daftar Penggunaan</h2>

        <!-- Tombol Generate PDF -->
        <button onclick="openRecipientModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Generate PDF
        </button>

        <!-- Tombol Tambah Penggunaan -->
        <a href="{{ route('penempatan-tambah') }}"
            class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
            Tambah Penggunaan
        </a>
    </div>

    <hr class="mb-6">

    <div class="content">
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

        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">No. Penggunaan</th>
                    <th class="py-2 px-4 border-b text-left">Kode Barang</th>
                    <th class="py-2 px-4 border-b text-left">Nama Barang</th>
                    <th class="py-2 px-4 border-b text-left">Tanggal Penggunaan</th>
                    <th class="py-2 px-4 border-b text-left">Keterangan</th>
                    <th class="py-2 px-4 border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penempatan as $p)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $p->kd_penempatan }}</td>
                        <td class="py-2 px-4 border-b">{{ $p->kd_barang }}</td>
                        <td class="py-2 px-4 border-b">{{ $p->nama_barang }}</td>
                        <td class="py-2 px-4 border-b">{{ $p->tgl_penempatan }}</td>
                        <td class="py-2 px-4 border-b">{{ $p->keterangan }}</td>
                        <td class="py-2 px-4 border-b text-right">
                            <button onclick="openModal('{{ $p->kd_penempatan }}')" class="bg-blue-500 text-white py-2 px-4 rounded">Detail</button>
                            <a href="{{ route('penempatan.edit', $p->kd_penempatan) }}" class="bg-yellow-500 text-white py-2 px-4 rounded">Edit</a>
                            <form action="{{ route('penempatan.destroy', $p->kd_penempatan) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus penempatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-6 flex">
            {{ $penempatan->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<!-- Modal for Detail View -->
<div id="modal-detail" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl w-full">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Detail Penggunaan</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div id="modal-content" class="overflow-y-auto max-h-[500px]">
            <!-- Content from AJAX will be inserted here -->
        </div>
    </div>
</div>

<!-- Modal for Recipient Name (PDF Generation) -->
<div id="recipientModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h3 class="text-xl font-semibold mb-4">Masukkan Nama Penerima</h3>
        <input type="text" id="recipientName" placeholder="Nama Penerima" class="w-full p-3 border border-gray-300 rounded mb-4">
        <div class="flex justify-end">
            <button onclick="generatePdf()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Generate PDF</button>
            <button onclick="closeRecipientModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
        </div>
    </div>
</div>

<script>
    function openModal(kd_penempatan) {
        document.getElementById('modal-detail').classList.remove('hidden');
        fetch(`/penempatan/${kd_penempatan}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('modal-content').innerHTML = html;
            });
    }

    function closeModal() {
        document.getElementById('modal-detail').classList.add('hidden');
    }

    function openRecipientModal() {
        document.getElementById('recipientModal').classList.remove('hidden');
    }

    function closeRecipientModal() {
        document.getElementById('recipientModal').classList.add('hidden');
    }

    function generatePdf() {
    const recipientName = document.getElementById('recipientName').value;
    if (recipientName) {
        // Trigger direct download with recipient name
        window.location.href = `{{ route('penempatan.generate-pdf') }}?recipient_name=${encodeURIComponent(recipientName)}`;
        closeRecipientModal();
    } else {
        alert('Silakan masukkan nama penerima.');
    }
}

</script>

@endsection
