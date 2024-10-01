@extends('layouts.homedash')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow-md max-w-[1475px] mx-auto px-8 mt-10">
    <div class="flex justify-between items-center mb-4 ">
        <h2 class="text-left text-xl font-semibold">Daftar Departemen</h2>
        <!-- Button tambah departemen -->
        <div class="flex justify-between items-center">
            <!-- Search Form -->
            <form method="GET" action="{{ route('departemen') }}" class="mb-4">
                <div class="flex items-center space-x-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama departemen" class="px-4 py-2 border rounded w-full" />
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Cari
                    </button>
                    <a href="{{ route('departemen') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
        </div>
        <div class=" flex justify-end mb-4">
            <a href="{{ route('departemen.create') }}"
                class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-900 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Tambah Departemen
            </a>
        </div>
    </div>
    <hr class="mb-6">
    <div class="content">
        <!-- Main Content -->
        <div class="container mx-auto p-8">
            <!-- Flash message after creating departemen -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Tabel daftar departemen -->
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Kode</th>
                        <th class="py-2 px-4 border-b text-left">Nama Departemen</th>
                        <th class="py-2 px-4 border-b text-left">Keterangan</th>
                        <th class="py-2 px-4 border-b text-right pr-[70px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departemen as $dept)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $dept->kode }}</td>
                            <td class="py-2 px-4 border-b">{{ $dept->nama_departemen }}</td>
                            <td class="py-2 px-4 border-b">{{ $dept->keterangan }}</td>
                            <td class="py-2 px-4 border-b text-right">
                                <!-- Edit -->
                                <a href="{{ route('departemen.edit', $dept->kode) }}"
                                    class="inline-block bg-yellow-500 text-white py-2 px-4 rounded text-sm font-medium mr-2 hover:bg-yellow-600">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('departemen.destroy', $dept->kode) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-2 px-4 rounded text-sm font-medium hover:bg-red-600"
                                        onclick="return confirm('Yakin ingin menghapus departemen ini?')">Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection