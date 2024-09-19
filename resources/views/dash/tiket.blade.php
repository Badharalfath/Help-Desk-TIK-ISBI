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

        <div class="flex justify-between items-center  pl-6 pr-6 mb-[-20px]">
            <h2 class="text-2xl font-bold mb-5">Tiket Kategori Jaringan</h2>

            <!-- Button tambah user -->

            <div class=" flex justify-end mb-4">
                <a href="{{ route('tickets.generatePdf') }}" class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Generate PDF
                </a>

                <a href="{{ route('tambahtiket') }}" class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Tambah Tiket
                </a>
            </div>
        </div>
        {{-- <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
            style="background-image: url('/path-to-background-image');">
            <table class="min-w-full divide-y divide-gray-200 mt-[30px]">
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
                                        <!-- {{ $ticket->tanggal->format('d/m/Y') }} -->
                                    @else
                                        {{ 'Tanggal tidak tersedia' }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $ticket->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $ticket->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $ticket->judul }}</div>
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
                                <div class="text-sm text-gray-900">{{ $ticket->reject_reason ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if ($ticket->progress_status == 'solved')
                                        <span
                                            class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                                    @elseif($ticket->progress_status == 'ongoing')
                                        <span
                                            class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On
                                            Going</span>
                                    @elseif($ticket->progress_status == 'unsolved')
                                        <span
                                            class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Unsolved</span>
                                    @elseif($ticket->progress_status == 'spam')
                                        <span
                                            class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Spam</span>
                                    @else
                                        <span
                                            class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Pending</span>
                                    @endif
                                </div>
                            </td>
                            @if ($isInput)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if ($ticket->permission_status != 'rejected')
                                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Open</a>
                                    @endif
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Anda sudah yakin ingin menghapus tiket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}

        <!-- Tabel Jaringan -->
        <div class="flex justify-between items-center pl-6 pr-6">

        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
            style="background-image: url('/path-to-background-image');">
            <table class="min-w-full divide-y divide-gray-200 mt-[30px]">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                            ID</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Date</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Nama</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Judul Keluhan</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Permission Status</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Alasan Ditolak</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Status Progress</th>
                        @if ($isInput)
                            <th
                                class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                                Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ticketsJaringan as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap w-1/12">{{ $ticket->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                {{ \Carbon\Carbon::parse($ticket->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">{{ Str::limit($ticket->name, 10) }}</td>
                            <!-- Limit name to 20 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">{{ Str::limit($ticket->judul, 25) }}</td>
                            <!-- Limit "Judul Keluhan" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">
                                {{ Str::limit($ticket->reject_reason ?? '-', 10) }}</td>
                            <!-- Limit "Alasan Ditolak" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                @if ($ticket->progress_status == 'solved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                                @elseif($ticket->progress_status == 'ongoing')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On
                                        Going</span>
                                @elseif($ticket->progress_status == 'unsolved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Unsolved</span>
                                @elseif($ticket->progress_status == 'spam')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Spam</span>
                                @else
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Pending</span>
                                @endif
                            </td>
                            @if ($isInput)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium w-1/12">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Open</a>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Anda sudah yakin ingin menghapus tiket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Aplikasi -->
        <div class="flex justify-between items-center pl-6 pr-6">
            <h2 class="text-2xl font-bold">Tiket Kategori Aplikasi</h2>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
            style="background-image: url('/path-to-background-image');">
            <table class="min-w-full divide-y divide-gray-200 mt-[30px]">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                            ID</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Date</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Nama</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Judul Keluhan</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Permission Status</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Alasan Ditolak</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Status Progress</th>
                        @if ($isInput)
                            <th
                                class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                                Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ticketsAplikasi as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap w-1/12">{{ $ticket->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                {{ \Carbon\Carbon::parse($ticket->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">{{ Str::limit($ticket->name, 10) }}</td>
                            <!-- Limit name to 20 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">{{ Str::limit($ticket->judul, 125) }}</td>
                            <!-- Limit "Judul Keluhan" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">
                                {{ Str::limit($ticket->reject_reason ?? '-', 10) }}</td>
                            <!-- Limit "Alasan Ditolak" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                @if ($ticket->progress_status == 'solved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                                @elseif($ticket->progress_status == 'ongoing')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On
                                        Going</span>
                                @elseif($ticket->progress_status == 'unsolved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Unsolved</span>
                                @elseif($ticket->progress_status == 'spam')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Spam</span>
                                @else
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Pending</span>
                                @endif
                            </td>
                            @if ($isInput)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium w-1/12">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Open</a>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Anda sudah yakin ingin menghapus tiket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Tabel Email/Website -->
        <div class="flex justify-between items-center pl-6 pr-6">
            <h2 class="text-2xl font-bold">Tiket Kategori Email/Website</h2>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
            style="background-image: url('/path-to-background-image');">
            <table class="min-w-full divide-y divide-gray-200 mt-[30px]">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                            ID</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Date</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Nama</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Judul Keluhan</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Permission Status</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">
                            Alasan Ditolak</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                            Status Progress</th>
                        @if ($isInput)
                            <th
                                class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                                Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ticketsEmailWebsite as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap w-1/12">{{ $ticket->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                {{ \Carbon\Carbon::parse($ticket->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">{{ Str::limit($ticket->name, 10) }}</td>
                            <!-- Limit name to 20 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">{{ Str::limit($ticket->judul, 25) }}</td>
                            <!-- Limit "Judul Keluhan" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap w-3/12">
                                {{ Str::limit($ticket->reject_reason ?? '-', 10) }}</td>
                            <!-- Limit "Alasan Ditolak" to 50 characters -->
                            <td class="px-6 py-4 whitespace-nowrap w-2/12">
                                @if ($ticket->progress_status == 'solved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                                @elseif($ticket->progress_status == 'ongoing')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On
                                        Going</span>
                                @elseif($ticket->progress_status == 'unsolved')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Unsolved</span>
                                @elseif($ticket->progress_status == 'spam')
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Spam</span>
                                @else
                                    <span
                                        class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Pending</span>
                                @endif
                            </td>
                            @if ($isInput)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium w-1/12">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Open</a>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Anda sudah yakin ingin menghapus tiket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
