@extends('layouts.homedash')

@section('content')
    <div class="overflow-x-auto mt-6 py-6 px-16">

        <div class="flex justify-between items-center mb-[-20px]">
            <h2 class="text-2xl font-bold mb-5">List Tabel Maintenance</h2>

            <div class=" flex justify-end mb-[-100px]">
                <a href="{{ route('jadwal') }}"
                    class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Input Jadwal
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <form id="filterForm" action="{{ route('listjadwal') }}" method="GET" class="mb-5 flex space-x-4 mt-5">
            <!-- Filter by Kategori -->
            <select name="kategori"
                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-[250px] p-2"
                onchange="document.getElementById('filterForm').submit()">
                <option value="">Pilih Kategori</option>
                <option value="Aplikasi & Website" {{ request('kategori') == 'Aplikasi & Website' ? 'selected' : '' }}>
                    Aplikasi & Website</option>
                <option value="Internet & Jaringan" {{ request('kategori') == 'Internet & Jaringan' ? 'selected' : '' }}>
                    Internet & Jaringan</option>
            </select>

            <!-- Filter by Status -->
            <select name="status"
                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-[250px] p-2"
                onchange="document.getElementById('filterForm').submit()">
                <option value="">Pilih Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>

            <!-- Search Input -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Deskripsi......"
                class="border-gray-300 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-[250px] p-2" />
        </form>

        <table class="min-w-full divide-y divide-gray-200 mt-6">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kategori }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Illuminate\Support\Str::limit($jadwal->deskripsi, 20) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('updateStatus', $jadwal->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded">
                                    <option value="Pending" {{ $jadwal->status == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Ongoing" {{ $jadwal->status == 'Ongoing' ? 'selected' : '' }}>Ongoing
                                    </option>
                                    <option value="Completed" {{ $jadwal->status == 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $jadwals->withQueryString()->links() }}
        </div>

    </div>
@endsection
