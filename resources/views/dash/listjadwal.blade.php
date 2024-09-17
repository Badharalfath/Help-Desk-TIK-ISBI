@extends('layouts.homedash')

@section('content')
<div class="overflow-x-auto mt-3 p-6">
    <div class="flex justify-between items-center">
        <h1 class="title-font text-black sm:text-4xl text-3xl font-medium">List Tabel Maintenance</h1>
        <div class="mb-4 flex justify-end">
            <a href="{{ route('jadwal') }}" class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Input Jadwal
            </a>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200 mt-6">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($jadwals as $jadwal)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kategori }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kegiatan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->deskripsi }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('updateStatus', $jadwal->id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded">
                            <option value="Pending" {{ $jadwal->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Ongoing" {{ $jadwal->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Completed" {{ $jadwal->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
