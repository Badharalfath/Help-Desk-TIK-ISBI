@extends('layouts.homedash')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk Admin</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-200 text-white font-sans">
    <div class="flex justify-between items-center mt-28 pl-6 pr-6">
        <h1 class="title-font text-black sm:text-4xl text-3xl font-medium">Daftar Antrian Tiket</h1>
        <div class="mb-4 flex justify-end">
            <a href="{{ route('tickets.generatePdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Generate PDF
            </a>
        </div>
    </div>
    <div class="flex justify-center items-center bg-cover bg-center px-6 rounded-xl mb-[50px]" style="background-image: url('/path-to-background-image');">
        <table class="min-w-full divide-y divide-gray-200 mt-[30px]">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul Keluhan
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Permission Status
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Alasan Ditolak
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status Progress
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($tickets as $ticket)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ticket->id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if($ticket->tanggal)
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
                        <div class="text-sm text-gray-900">{{ $ticket->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ticket->judul }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap ">
                        <div class="text-sm text-gray-900">
                            @if($ticket->permission_status == 'approved')
                                <span class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Approved</span>
                            @else
                                <span class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-red-500">Rejected</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ticket->reject_reason ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap ">
                        <div class="text-sm text-gray-900">
                            @if($ticket->progress_status == 'solved')
                            <span class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-green-500">Solved</span>
                            @elseif($ticket->progress_status == 'ongoing')
                            <span class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-yellow-500">On Going</span>
                            @else
                            <span class="text-white text-bold text-center inline-block w-20 h-6 rounded-full bg-gray-500">Unsolved</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
