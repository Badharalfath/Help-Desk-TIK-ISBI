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

                    <h3 class="text-lg font-semibold mb-2">Penerima Pihak Pertama</h3>
                    <!-- Input Nama -->
                    <input type="text" id="firstPartyName" placeholder="Nama Penerima Pihak Pertama"
                        class="w-full p-3 border border-gray-300 rounded mb-4">

                    <!-- Input NIP -->
                    <input type="text" id="firstPartyNip" placeholder="NIP Penerima Pihak Pertama"
                        class="w-full p-3 border border-gray-300 rounded mb-4">

                    <!-- Input Jabatan -->
                    <input type="text" id="firstPartyPosition" placeholder="Jabatan Penerima Pihak Pertama"
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

        <!-- Detail Modal -->
        <div id="detailModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full overflow-auto">
                <h3 class="text-xl font-semibold mb-4">Detail Transaksi</h3>
                <div id="detailContent" class="space-y-4">
                    <!-- Detail isi akan diisi oleh JavaScript -->
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="closeDetailModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
                </div>
            </div>
        </div>

        <style>
            #detailModal img {
                max-width: 100%;
                /* Batas lebar sesuai modal */
                max-height: 30rem;
                /* Tinggi maksimum gambar */
                object-fit: contain;
                /* Menjaga proporsi gambar */
            }
        </style>

        <script>
            function openRecipientModal() {
                document.getElementById('recipientModal').classList.remove('hidden');
            }

            function closeRecipientModal() {
                document.getElementById('recipientModal').classList.add('hidden');
            }

            function showDetail(item) {
                const detailContent = document.getElementById('detailContent');

                // Isi detail modal
                detailContent.innerHTML = `
        <p><strong>Kode Transaksi:</strong> ${item.kd_transaksi || 'Tidak tersedia'}</p>
        <p><strong>Tanggal Transaksi:</strong> ${item.tgl_transaksi || 'Tidak tersedia'}</p>
        <p><strong>Keterangan:</strong> ${item.keterangan || 'Tidak tersedia'}</p>
        <p><strong>Nama Barang:</strong> ${item.nama_barang || 'Tidak tersedia'}</p>
        ${
            item.nota 
            ? `
                                                        <p><strong>Nota:</strong></p>
                                                        <div class="flex justify-center">
                                                            <img src="/storage/fotos/${item.nota}" alt="Nota Transaksi" class="max-w-full max-h-64 object-contain">
                                                        </div>
                                                    ` 
            : '<p><strong>Nota:</strong> Tidak ada nota</p>'
        }
    `;

                // Tampilkan modal
                document.getElementById('detailModal').classList.remove('hidden');
            }


            function closeDetailModal() {
                document.getElementById('detailModal').classList.add('hidden');
            }

            // Submit Form untuk Generate PDF
            function submitPdfForm() {
                const recipientName = document.getElementById('recipientName').value.trim();
                const recipientNip = document.getElementById('recipientNip').value.trim();
                const firstPartyName = document.getElementById('firstPartyName').value.trim();
                const firstPartyNip = document.getElementById('firstPartyNip').value.trim();
                const firstPartyPosition = document.getElementById('firstPartyPosition').value.trim();

                const selectedTransaksi = Array.from(document.querySelectorAll('.transaksi-checkbox:checked'))
                    .map(checkbox => checkbox.value);

                // Validasi input
                if (!recipientName || !recipientNip) {
                    alert('Harap isi Nama dan NIP Penerima.');
                    return;
                }

                if (selectedTransaksi.length === 0) {
                    alert('Silakan pilih transaksi yang ingin dimasukkan ke dalam PDF.');
                    return;
                }

                // Buat form dinamis untuk submit data
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('generate-pdf') }}`;

                // Tambahkan CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = `{{ csrf_token() }}`;
                form.appendChild(csrfToken);

                // Tambahkan input untuk Nama Penerima dan NIP
                const recipientNameInput = document.createElement('input');
                recipientNameInput.type = 'hidden';
                recipientNameInput.name = 'recipient_name';
                recipientNameInput.value = recipientName;
                form.appendChild(recipientNameInput);

                const recipientNipInput = document.createElement('input');
                recipientNipInput.type = 'hidden';
                recipientNipInput.name = 'recipient_nip';
                recipientNipInput.value = recipientNip;
                form.appendChild(recipientNipInput);

                // Tambahkan input untuk Penerima Pihak Pertama
                const firstPartyNameInput = document.createElement('input');
                firstPartyNameInput.type = 'hidden';
                firstPartyNameInput.name = 'first_party_name';
                firstPartyNameInput.value = firstPartyName;
                form.appendChild(firstPartyNameInput);

                const firstPartyNipInput = document.createElement('input');
                firstPartyNipInput.type = 'hidden';
                firstPartyNipInput.name = 'first_party_nip';
                firstPartyNipInput.value = firstPartyNip;
                form.appendChild(firstPartyNipInput);

                const firstPartyPositionInput = document.createElement('input');
                firstPartyPositionInput.type = 'hidden';
                firstPartyPositionInput.name = 'first_party_position';
                firstPartyPositionInput.value = firstPartyPosition;
                form.appendChild(firstPartyPositionInput);

                // Tambahkan transaksi terpilih
                selectedTransaksi.forEach(transaksiId => {
                    const transaksiInput = document.createElement('input');
                    transaksiInput.type = 'hidden';
                    transaksiInput.name = 'transaksi[]';
                    transaksiInput.value = transaksiId;
                    form.appendChild(transaksiInput);
                });

                // Submit form
                document.body.appendChild(form);
                form.submit();

                // Tutup modal
                closeRecipientModal();
            }
        </script>

    </div>

@endsection
