@extends('layouts.homedash')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-200 text-black font-sans">
<main class="container mx-auto py-10">
    <h1 class="title-font text-black sm:text-4xl text-3xl mt-24 pl-6 font-medium">Daftar Kelola Jadwal</h1>
        <div class="flex flex-col md:flex-row justify-center mt-[40px]">
            <div class="w-full md:w-1/2 mr-4">
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4">Jadwal Maintenance</h2>
                    <div class="flex justify-between items-center mb-4">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <span class="text-gray-700 font-bold">Agustus 2024</span>
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left py-2 px-4">DAY</th>
                                <th class="text-left py-2 px-4">DAY</th>
                                <th class="text-left py-2 px-4">DAY</th>
                                <th class="text-left py-2 px-4">DAY</th>
                                <th class="text-left py-2 px-4">DAY</th>
                                <th class="text-left py-2 px-4">DAY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center py-2 px-4">1</td>
                                <td class="text-center py-2 px-4">2</td>
                                <td class="text-center py-2 px-4">3</td>
                                <td class="text-center py-2 px-4">4</td>
                                <td class="text-center py-2 px-4">5</td>
                                <td class="text-center py-2 px-4">6</td>
                            </tr>
                            <tr>
                                <td class="text-center py-2 px-4">7</td>
                                <td class="text-center py-2 px-4">8</td>
                                <td class="text-center py-2 px-4">9</td>
                                <td class="text-center py-2 px-4">10</td>
                                <td class="text-center py-2 px-4">11</td>
                                <td class="text-center py-2 px-4">12</td>
                            </tr>
                            <tr>
                                <td class="text-center py-2 px-4">13</td>
                                <td class="text-center py-2 px-4">14</td>
                                <td class="text-center py-2 px-4">15</td>
                                <td class="text-center py-2 px-4">16</td>
                                <td class="text-center py-2 px-4">17</td>
                                <td class="text-center py-2 px-4">18</td>
                            </tr>
                            <tr>
                                <td class="text-center py-2 px-4">19</td>
                                <td class="text-center py-2 px-4">20</td>
                                <td class="text-center py-2 px-4">21</td>
                                <td class="text-center py-2 px-4">22</td>
                                <td class="text-center py-2 px-4">23</td>
                                <td class="text-center py-2 px-4">24</td>
                            </tr>
                            <tr>
                                <td class="text-center py-2 px-4">25</td>
                                <td class="text-center py-2 px-4">26</td>
                                <td class="text-center py-2 px-4">27</td>
                                <td class="text-center py-2 px-4">28</td>
                                <td class="text-center py-2 px-4">29</td>
                                <td class="text-center py-2 px-4">30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4">Tambahkan Jadwal</h2>
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal</label>
                        <input type="date" id="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi Maintenance</label>
                        <textarea id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700 font-bold mb-2">Foto Dokumentasi</label>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-2">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l.636-.636a2 2 0 012.828 0L20 14m-4.636 4.636a2 2 0 01-2.828 0L8 12m4.636-4.636a2 2 0 012.828 0L12 8z"></path></svg>
                            </div>
                            <input type="file" id="foto" class="hidden">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="choose-file-button">Choose File</button>
                            <span class="ml-2 text-gray-600" id="file-name">No File Chosen</span>
                        </div>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambahkan Jadwal</button>
                </div>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    <script>
        const chooseFileButton = document.getElementById('choose-file-button');
        const fileInput = document.getElementById('foto');
        const fileNameDisplay = document.getElementById('file-name');

        chooseFileButton.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                fileNameDisplay.textContent = file.name;
            } else {
                fileNameDisplay.textContent = 'No File Chosen';
            }
        });
    </script>

</body>
</html>
