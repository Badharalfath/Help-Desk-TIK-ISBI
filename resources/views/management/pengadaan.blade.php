@extends('layouts.homedash')

@section('content')

    <div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
        <div class="flex justify-between items-center mb-4 ">
            <h2 class="text-left text-xl font-semibold">Data Transaksi</h2>
            <!-- Trigger the modal -->
            <button onclick="openRecipientModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Generate PDF
            </button>
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
                            <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                <input type="checkbox" name="transaksi[]" value="{{ $item->kd_transaksi }}"
                                    class="transaksi-checkbox">
                            </td>
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

            <!-- Recipient Modal -->
            <div id="recipientModal"
                class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h3 class="text-xl font-semibold mb-4">Masukkan Nama Penerima dan NIP</h3>

                    <!-- Input Nama Penerima -->
                    <input type="text" id="recipientName" placeholder="Nama Penerima"
                        class="w-full p-3 border border-gray-300 rounded mb-4">

                    <!-- Input NIP -->
                    <input type="text" id="recipientNip" placeholder="NIP Penerima"
                        class="w-full p-3 border border-gray-300 rounded mb-4">

                    <div class="flex justify-end">
                        <button onclick="submitPdfForm()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Generate
                            PDF</button>
                        <button onclick="closeRecipientModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openRecipientModal() {
                document.getElementById('recipientModal').classList.remove('hidden');
            }

            function closeRecipientModal() {
                document.getElementById('recipientModal').classList.add('hidden');
            }

            function submitPdfForm() {
                const recipientName = document.getElementById('recipientName').value;
                const recipientNip = document.getElementById('recipientNip').value;
                const selectedTransaksi = Array.from(document.querySelectorAll('.transaksi-checkbox:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedTransaksi.length === 0) {
                    alert('Silakan pilih transaksi yang ingin dimasukkan ke dalam PDF.');
                    return;
                }

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('generate-pdf') }}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = `{{ csrf_token() }}`;
                form.appendChild(csrfToken);

                const recipientInput = document.createElement('input');
                recipientInput.type = 'hidden';
                recipientInput.name = 'recipient_name';
                recipientInput.value = recipientName;
                form.appendChild(recipientInput);

                const nipInput = document.createElement('input');
                nipInput.type = 'hidden';
                nipInput.name = 'recipient_nip';
                nipInput.value = recipientNip;
                form.appendChild(nipInput);

                selectedTransaksi.forEach(transaksiId => {
                    const transaksiInput = document.createElement('input');
                    transaksiInput.type = 'hidden';
                    transaksiInput.name = 'transaksi[]';
                    transaksiInput.value = transaksiId;
                    form.appendChild(transaksiInput);
                });

                document.body.appendChild(form);
                form.submit();

                closeRecipientModal();
            }
        </script>
    </div>

@endsection
