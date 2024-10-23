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

    <body class="bg-gray-200 text-black font-sans">

        <div class="flex flex-col md:flex-row justify-center" style="background-image: url('/path-to-background-image');">
            <div class="max-w-7xl mx-auto p-6  mb-[50px]">

                @if ($errors->any())
                    <div class="flex items-center p-4 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 mb-[20px]"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            @foreach ($errors->all() as $item)
                                <span class="font-medium">&nbsp;Info </span>{{ $item }}
                            @endforeach
                        </div>
                    </div>
                @endif

                <h2 class="text-xl font-bold mb-2 mt-4">Status Tiket</h2>

                <!-- Grid pertama -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Mini Table Section -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <table class="min-w-full text-left text-gray-700">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2 text-left ">Status</th>
                                    <th class="border-b px-4 py-2 text-left ">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-b px-4 py-2">Pending</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->pending }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Ongoing</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->ongoing }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Completed</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->completed }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Spam</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->spam }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Rejected</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->rejected }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pie Chart Section kedua -->
                    <div class="bg-white shadow rounded-lg h-[280px] p-6 flex items-center justify-center">
                        <div class="flex items-center justify-between w-full">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>

                    <!-- Bar Chart Section -->
                    <div class="bg-white shadow rounded-lg p-6 h-[280px]">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-2 mt-4">Kategori Tiket</h2>

                <!-- Grid kedua -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
                    <!-- Grid 2: Ticket Counts by Category -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <table class="min-w-full text-left text-gray-700">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2">Kategori</th>
                                    <th class="border-b px-4 py-2">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-b px-4 py-2">Aplikasi</td>
                                    <td class="border-b px-4 py-2">{{ $ticketCategories->aplikasi }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Email</td>
                                    <td class="border-b px-4 py-2">{{ $ticketCategories->email }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Jaringan/Internet</td>
                                    <td class="border-b px-4 py-2">{{ $ticketCategories->jaringan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pie Chart Section kedua -->
                    <div class="bg-white shadow rounded-lg p-6 max-h-[250px] flex items-center justify-center">
                        <div class="flex items-center justify-between w-full">
                            <canvas id="pieChart2"></canvas>
                        </div>
                    </div>

                    <!-- Bar Chart Section kedua -->
                    <div class="bg-white shadow rounded-lg p-6 max-h-[250px]">
                        <div class="p-[20px]">
                            <canvas id="barChart2"></canvas>
                        </div>
                    </div>
                </div>
                <h2 class="text-xl font-bold mb-2 mt-4">Status Maintenance</h2>

                <!-- Grid ketiga -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
                    <!-- Div Card besar 2x2 (Table) -->
                    <div class="md:col-span-2 bg-white shadow rounded-lg p-6 h-full max-h-[525px] overflow-auto">

                        <table class="min-w-full text-left text-gray-700">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2">Tanggal</th>
                                    <th class="border-b px-4 py-2">Kegiatan</th>
                                    <th class="border-b px-4 py-2">Kategori</th>
                                    <th class="border-b px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td class="border-b px-4 py-2">{{ $schedule->tanggal }}</td>
                                        <td class="border-b px-4 py-2">{{ $schedule->kegiatan }}</td>
                                        <td class="border-b px-4 py-2">{{ $schedule->kd_layanan }}</td>
                                        <td class="border-b px-4 py-2">{{ $schedule->kd_progres }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Container for Pie and Bar Charts -->
                    <div class="md:col-span-1 grid grid-rows-2 gap-6">
                        <!-- Pie Chart for Jadwal by Status -->
                        <div class="bg-white shadow rounded-lg max-h-[250px] flex items-center justify-center">
                            <canvas id="schedulePieChart"></canvas>
                        </div>

                        <!-- Bar Chart for Jadwal by Status -->
                        <div class="bg-white shadow rounded-lg p-6 max-h-[250px]">
                            <canvas id="scheduleBarChart"></canvas>
                        </div>
                    </div>
                </div>


                <script>
                    // Data for charts from Blade variables
                    const ticketStatuses = @json($ticketStatuses);
                    const ticketCategories = @json($ticketCategories);
                    const scheduleData = @json($scheduleData);

                    // Pie Chart for Ticket Statuses
                    const pieCtx = document.getElementById('pieChart').getContext('2d');
                    const pieChart = new Chart(pieCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Pending', 'Ongoing', 'Completed', 'Spam', 'Rejected'],
                            datasets: [{
                                data: [ticketStatuses.pending, ticketStatuses.ongoing, ticketStatuses.completed,
                                    ticketStatuses.spam, ticketStatuses.rejected
                                ],
                                backgroundColor: ['#FFCC00', '#FF8000', '#4CAF50', '#FF3333', '#999999'],
                            }]
                        }
                    });

                    // Bar Chart for Ticket Statuses
                    const barCtx = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Pending', 'Ongoing', 'Completed', 'Spam', 'Rejected'],
                            datasets: [{
                                label: 'Jumlah Tiket',
                                data: [ticketStatuses.pending, ticketStatuses.ongoing, ticketStatuses.completed,
                                    ticketStatuses.spam, ticketStatuses.rejected
                                ],
                                backgroundColor: ['#FFCC00', '#FF8000', '#4CAF50', '#FF3333', '#999999'],
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Pie Chart for Ticket Categories
                    const pieCtx2 = document.getElementById('pieChart2').getContext('2d');
                    const pieChart2 = new Chart(pieCtx2, {
                        type: 'pie',
                        data: {
                            labels: ['Aplikasi', 'Email', 'Jaringan'],
                            datasets: [{
                                data: [ticketCategories.aplikasi, ticketCategories.email, ticketCategories.jaringan],
                                backgroundColor: ['#FFCC00', '#FF8000', '#4CAF50'],
                            }]
                        }
                    });

                    // Bar Chart for Ticket Categories
                    const barCtx2 = document.getElementById('barChart2').getContext('2d');
                    const barChart2 = new Chart(barCtx2, {
                        type: 'bar',
                        data: {
                            labels: ['Aplikasi', 'Email', 'Jaringan'],
                            datasets: [{
                                label: 'Jumlah Tiket',
                                data: [ticketCategories.aplikasi, ticketCategories.email, ticketCategories.jaringan],
                                backgroundColor: ['#FFCC00', '#FF8000', '#4CAF50'],
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Pie Chart for Schedule Statuses
                    const schedulePieCtx = document.getElementById('schedulePieChart').getContext('2d');
                    const schedulePieChart = new Chart(schedulePieCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Completed', 'In Progress', 'Pending'],
                            datasets: [{
                                data: [scheduleData.completed, scheduleData.in_progress, scheduleData.pending],
                                backgroundColor: ['#4CAF50', '#FF8000', '#FFCC00'],
                            }]
                        }
                    });

                    // Bar Chart for Schedule Statuses
                    const scheduleBarCtx = document.getElementById('scheduleBarChart').getContext('2d');
                    const scheduleBarChart = new Chart(scheduleBarCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Completed', 'In Progress', 'Pending'],
                            datasets: [{
                                label: 'Jumlah Jadwal',
                                data: [scheduleData.completed, scheduleData.in_progress, scheduleData.pending],
                                backgroundColor: ['#4CAF50', '#FF8000', '#FFCC00'],
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </body>

    </html>
@endsection
