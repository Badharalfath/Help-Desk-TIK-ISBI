@extends('layouts.homedash')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="container mx-auto ">


        <div class="container mx-auto py-10 px-6"> <!-- Tambahkan 'px-6' untuk padding pada sisi horizontal -->
            <!-- Tabel Default (Semua Tiket) -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="flex justify-between items-center mb-">

                <h2 class="text-2xl font-bold mb-5">Daftar Tiket</h2>

                <!-- Button tambah user -->
                <div class=" flex justify-end mb-4">
                    <a href="{{ route('tickets.generatePdf') }}"
                        class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Generate PDF
                    </a>

                    <a href="{{ route('tambahtiket') }}"
                        class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Tambah Tiket
                    </a>
                </div>
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('tiket') }}" id="filterForm">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Filter by Layanan (previously Kategori) -->
                    <div>
                        <label for="kd_layanan" class="block text-sm font-medium text-gray-700">Layanan</label>
                        <select name="kategori" id="kd_layanan"
                            class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                            <option value="">Semua Layanan</option>
                            @foreach ($kategoriLayanan as $layanan)
                                <option value="{{ $layanan->kd_layanan }}"
                                    {{ request('kategori') == $layanan->kd_layanan ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Status -->
                    <div>
                        <label for="kd_status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="kd_status"
                            class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                            <option value="">Semua Status</option>
                            @foreach ($kategoriStatus as $status)
                                <option value="{{ $status->kd_status }}"
                                    {{ request('status') == $status->kd_status ? 'selected' : '' }}>
                                    {{ $status->nama_status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Progress -->
                    <div>
                        <label for="kd_progres" class="block text-sm font-medium text-gray-700">Progress</label>
                        <select name="progress" id="kd_progres"
                            class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                            <option value="">Semua Progress</option>
                            @foreach ($kategoriProgres as $progres)
                                <option value="{{ $progres->kd_progres }}"
                                    {{ request('progress') == $progres->kd_progres ? 'selected' : '' }}>
                                    {{ $progres->nama_progres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Input -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Cari Data..."
                            class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2" />
                    </div>



                    <!-- Clear Button -->
                    <div>
                        <a href="{{ route('tiket') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>


            <!-- Tabel Tiket -->
            <div class="flex justify-center items-center bg-cover bg-center rounded-xl mt-[-20px]"
                style="background-image: url('/path-to-background-image');">
                <table class="min-w-full divide-y divide-gray-200 mt-[30px] ">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul Keluhan</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Alasan Ditolak</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                progres</th>
                            @if ($isInput)
                                <th
                                    class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $ticket->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($ticket->tanggal)
                                            {{ \Carbon\Carbon::parse($ticket->tanggal)->format('d/m/Y') }}
                                        @else
                                            {{ 'Tanggal tidak tersedia' }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $ticket->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" title="{{ $ticket->name }}">
                                        {{ \Illuminate\Support\Str::limit($ticket->name, 10) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" title="{{ $ticket->judul }}">
                                        {{ \Illuminate\Support\Str::limit($ticket->judul, 10) }}
                                    </div>
                                </td>
                                <!-- Kategori Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $ticket->kategoriLayanan->nama_layanan ?? 'N/A' }}</div>
                                </td>
                                <!-- Status Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($ticket->kategoriStatus)
                                            <span
                                                class="text-white text-bold text-center inline-block w-20 h-6 rounded-full {{ $ticket->kategoriStatus->nama_status == 'approved' ? 'bg-green-500' : ($ticket->kategoriStatus->nama_status == 'rejected' ? 'bg-red-500' : 'bg-gray-500') }}">
                                                {{ ucfirst($ticket->kategoriStatus->nama_status) }}
                                            </span>
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" title="{{ $ticket->reject_reason }}">
                                        {{ \Illuminate\Support\Str::limit($ticket->reject_reason, 10) }}
                                    </div>
                                </td>
                                <!-- progres Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($ticket->kategoriProgres)
                                            <span
                                                class="text-white text-bold text-center inline-block w-20 h-6 rounded-full
                    {{ $ticket->kategoriProgres->nama_progres == 'pending'
                        ? 'bg-gray-500'
                        : ($ticket->kategoriProgres->nama_progres == 'on going'
                            ? 'bg-orange-500'
                            : ($ticket->kategoriProgres->nama_progres == 'complete'
                                ? 'bg-green-500'
                                : 'bg-gray-500')) }}">
                                                {{ ucfirst($ticket->kategoriProgres->nama_progres) }}
                                            </span>
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>


                                @if ($isInput)
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <script>
                    // Listen for changes on any filter field and submit the form automatically
                    document.querySelectorAll('#filterForm select, #filterForm input[type="date"]').forEach(function(element) {
                        element.addEventListener('change', function() {
                            document.getElementById('filterForm').submit();
                        });
                    });
                </script>
            </div>
            <!-- Pagination Links -->
            <div class="mt-6 ">
                {{ $tickets->links() }}
            </div>
        </div>
    @endsection
