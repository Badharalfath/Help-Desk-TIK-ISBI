@extends('layouts.homedash')

@section('content')
    <div class="container mx-auto py-10">
        <!-- Tabel Default (Semua Tiket) -->
        <div class="flex justify-between items-center  pl-6 pr-6">
            <h1 class="title-font text-black sm:text-4xl text-3xl font-medium">Daftar Antrian Tiket</h1>
            <div class="mb-[-30px] flex justify-end">
                @if ($isInput)
                    <a href="{{ route('tickets.generatePdf') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Generate PDF
                    </a>
                    <a href="{{ route('tambahtiket') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded">
                        Input Tiket
                    </a>
                @endif
            </div>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
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
        </div>

        <!-- Tabel Jaringan -->
        <div class="flex justify-between items-center  pl-6 pr-6">
            <h2 class="text-2xl font-bold">Tiket Kategori Jaringan</h2>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
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
                            Lokasi</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul Keluhan</th>
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
                    @foreach ($ticketsJaringan as $ticket)
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
                                <div class="text-sm text-gray-900">{{ $ticket->lokasi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $ticket->judul }}</div>
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
        </div>

        <!-- Tabel Aplikasi -->
        <div class="flex justify-between items-center  pl-6 pr-6">
            <h2 class="text-2xl font-bold">Tiket Kategori Aplikasi</h2>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
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
                            Status Progress</th>
                        @if ($isInput)
                            <th
                                class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        @endif

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ticketsAplikasi as $ticket)
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

        <!-- Tabel Email/Website -->
        <div class="flex justify-between items-center  pl-6 pr-6">
            <h2 class="text-2xl font-bold">Tiket Kategori Email/Website</h2>
        </div>
        <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]"
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
                            Status Progress</th>
                        @if ($isInput)
                            <th
                                class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        @endif

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ticketsEmailWebsite as $ticket)
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
