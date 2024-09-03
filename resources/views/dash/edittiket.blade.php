@extends('layouts.homedash')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-sans"> 

    <!-- Ticket Form -->
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white text-black rounded-lg shadow-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center mb-4">Ticket Details</h2>

            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <div class="text-black">
                        <p>{{ $error }}</p>
                    </div>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('ticket.update', $ticket->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" value="{{ $ticket->email }}" class="w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Name" value="{{ $ticket->name }}" class="w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div class="mb-4">
                    <input type="text" name="judul" placeholder="Complaint Title" value="{{ $ticket->judul }}" class="w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div class="mb-4">
                    <textarea name="keluhan" placeholder="Complaint" class="w-full p-2 border border-gray-300 rounded" readonly>{{ $ticket->keluhan }}</textarea>
                </div>
                <div class="mb-4 flex justify-around">
                    <label>
                        <input type="radio" name="permission_status" value="rejected" {{ $ticket->permission_status == 'approved' ? 'checked' : '' }} class="mr-2"> Rejected
                    </label>
                    <label>
                        <input type="radio" name="permission_status" value="approved" {{ $ticket->permission_status == 'rejected' ? 'checked' : '' }} class="mr-2"> Approved
                    </label>
                </div>
                <div class="mb-4">
                    <div class="flex items-center space-x-4">
                        <label>
                            <input type="radio" name="progress_status" value="unresolved" {{ $ticket->progress_status == 'unresolved' ? 'checked' : '' }} class="mr-2"> Unsolved
                        </label>
                        <label>
                            <input type="radio" name="progress_status" value="ongoing" {{ $ticket->progress_status == 'ongoing' ? 'checked' : '' }} class="mr-2"> On Going
                        </label>
                        <label>
                            <input type="radio" name="progress_status" value="solved" {{ $ticket->progress_status == 'solved' ? 'checked' : '' }} class="mr-2"> Solved
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <input type="text" name="reject_reason" placeholder="Reject Reason" value="{{ $ticket->reject_reason }}" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded">Save</button>
            </form>

        </div>
    </div>

</body>
</html>
@endsection
