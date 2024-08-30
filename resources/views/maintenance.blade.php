@extends('layouts.homelayout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-[url('https://dummyimage.com/1920x1080/000/fff')] text-black font-sans">

    <!-- Main Content -->
    <div class="container mx-auto mt-12 p-6 ">
        <div class="flex mt-[65px] mb-[50px]">
            <!-- Jadwal Maintenance -->
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

            <!-- Detail Maintenance -->
            <div class="w-2/3 ml-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Detail Maintenance</h2>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Keterangan</h3>
                        <p class="bg-gray-200 p-4 rounded-lg">Lorem ipsum dolor sit amet consectetur. Ligula arcu leo ut bibendum faucibus tellus.</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Waktu Maintenance</h3>
                        <p class="bg-gray-200 p-4 rounded-lg">Senin 24 Agustus 2024 &nbsp;&nbsp;&nbsp; 15:00 - 18:30</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Dokumentasi</h3>
                        <img src="https://via.placeholder.com/150" alt="Dokumentasi" class="rounded-lg shadow-md">
                    </div>
                    <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600">
                        Generate Report
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

@endsection
