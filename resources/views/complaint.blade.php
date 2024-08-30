@extends('layouts.homelayout')

@section('content')
<!-- resources/views/complaint.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-[url('https://dummyimage.com/1920x1080/000/fff')]">
    

    <main class="container mx-auto py-10">
    <div class="flex flex-col md:flex-row justify-center mt-32 mb-[50px]">
        <div class="w-full md:w-1/2">
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-bold mb-4">Form Keluhan</h2>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                    <input type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Keluhan</label>
                    <input type="text" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="keluhan" class="block text-gray-700 font-bold mb-2">Keluhan</label>
                    <textarea id="keluhan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Generate Report</button>
            </div>
        </div>
    </div>
</main>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
</body>
</html>