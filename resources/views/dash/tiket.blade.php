@extends('layouts.homedash')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="container mx-auto py-10">
        <!-- Tabel Default (Semua Tiket) -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="container mx-auto py-10 px-6"> <!-- Tambahkan 'px-6' untuk padding pada sisi horizontal -->
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
            <div class="mb-6">
                <form method="GET" action="{{ route('tiket') }}" id="filterForm">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Filter by Date -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                        </div>

                        <!-- Filter by Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                                <option value="">Semua Kategori</option>
                                <option value="Jaringan" {{ request('kategori') == 'Jaringan' ? 'selected' : '' }}>Jaringan
                                </option>
                                <option value="Aplikasi" {{ request('kategori') == 'Aplikasi' ? 'selected' : '' }}>Aplikasi
                                </option>
                                <option value="Email/Website"
                                    {{ request('kategori') == 'Email/Website' ? 'selected' : '' }}>
                                    Email/Website</option>
                            </select>
                        </div>

                        <!-- Filter by Permission Status -->
                        <div>
                            <label for="permission_status" class="block text-sm font-medium text-gray-700">Permission
                                Status</label>
                            <select name="permission_status" id="permission_status"
                                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                                <option value="">Semua Status</option>
                                <option value="approved" {{ request('permission_status') == 'approved' ? 'selected' : '' }}>
                                    Approved</option>
                                <option value="rejected" {{ request('permission_status') == 'rejected' ? 'selected' : '' }}>
                                    Rejected</option>
                                <option value="pending" {{ request('permission_status') == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                            </select>
                        </div>

                        <!-- Filter by Progress Status -->
                        <div>
                            <label for="progress_status" class="block text-sm font-medium text-gray-700">Progress
                                Status</label>
                            <select name="progress_status" id="progress_status"
                                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
                                <option value="">Semua Status</option>
                                <option value="solved" {{ request('progress_status') == 'solved' ? 'selected' : '' }}>
                                    Solved</option>
                                <option value="ongoing" {{ request('progress_status') == 'ongoing' ? 'selected' : '' }}>On
                                    Going</option>
                                <option value="unsolved" {{ request('progress_status') == 'unsolved' ? 'selected' : '' }}>
                                    Unsolved</option>
                                <option value="spam" {{ request('progress_status') == 'spam' ? 'selected' : '' }}>Spam
                                </option>
                            </select>
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
                                    Permission Status</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alasan Ditolak</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status Progress</th>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $ticket->kategori }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if ($ticket->permission_status == 'approved')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Approved</span>
                                            @elseif($ticket->permission_status == 'rejected')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Rejected</span>
                                            @elseif($ticket->permission_status == 'pending')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Pending</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900" title="{{ $ticket->reject_reason }}">
                                            {{ \Illuminate\Support\Str::limit($ticket->reject_reason, 10) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if ($ticket->progress_status == 'solved')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                                            @elseif($ticket->progress_status == 'unsolved')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Unsolved</span>
                                            @elseif($ticket->progress_status == 'ongoing')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On
                                                    Going</span>
                                            @elseif($ticket->progress_status == 'spam')
                                                <span
                                                    class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Spam</span>
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
