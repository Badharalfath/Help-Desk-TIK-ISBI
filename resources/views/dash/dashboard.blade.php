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

                <h2 class="text-xl font-bold mb-2">Status Tiket</h2>

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
                                    <td class="border-b px-4 py-2">Unsolved</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->unsolved }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Ongoing</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->ongoing }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Solved</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->solved }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-4 py-2">Pending</td>
                                    <td class="border-b px-4 py-2">{{ $ticketStatuses->pending }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pie Chart Section kedua -->
                    <div class="bg-white shadow rounded-lg p-6 max-h-[250px] flex items-center justify-center">
                        <div class="flex items-center justify-between w-full">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>

                    <!-- Bar Chart Section -->
                    <div class="bg-white shadow rounded-lg p-6 max-h-[250px]">
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
                                    <td class="border-b px-4 py-2">Email/Website</td>
                                    <td class="border-b px-4 py-2">{{ $ticketCategories->email_website }}</td>
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
                                        <td class="border-b px-4 py-2">{{ $schedule->kategori }}</td>
                                        <td class="border-b px-4 py-2">{{ $schedule->status }}</td>
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

                    // Pie Chart Data
                    const ctxPie = document.getElementById('pieChart').getContext('2d');
                    const pieChart = new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Pending', 'Unsolved', 'Ongoing', 'Solved'],
                            datasets: [{
                                data: [ticketStatuses.pending, ticketStatuses.unsolved, ticketStatuses.ongoing,
                                    ticketStatuses.solved
                                ],
                                backgroundColor: ['#9CA3AF', '#6B7280', '#FBBF24',
                                    '#10B981'
                                ], // Light Gray, Gray, Yellow, Green
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'right', // Pindahkan legend ke sebelah kiri
                                    labels: {
                                        boxWidth: 15, // Lebar kotak warna pada legend
                                        padding: 30, // Jarak antara legend dengan chart
                                    }
                                }
                            },
                            layout: {
                                padding: {
                                    left: 0, // Tambahkan padding agar chart tidak terlalu menempel
                                }
                            }
                        }
                    });

                    // Bar Chart Data
                    const ctxBar = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: ['Pending', 'Unsolved', 'Ongoing', 'Solved'],
                            datasets: [{
                                label: 'Ticket Status Count',
                                data: [ticketStatuses.pending, ticketStatuses.unsolved, ticketStatuses.ongoing,
                                    ticketStatuses.solved
                                ],
                                backgroundColor: ['#9CA3AF', '#6B7280', '#FBBF24',
                                    '#10B981'
                                ], // Light Gray, Gray, Yellow, Green
                            }]
                        },
                        options: {
                            indexAxis: 'y', // Horizontal bar chart
                        }
                    });

                    // Data for charts from Blade variables
                    const ticketCategories = @json($ticketCategories);

                    // Pie Chart for Categories
                    const ctxPie2 = document.getElementById('pieChart2').getContext('2d');
                    const pieChart2 = new Chart(ctxPie2, {
                        type: 'pie',
                        data: {
                            labels: ['Aplikasi', 'Email/Website', 'Jaringan/Internet'],
                            datasets: [{
                                data: [ticketCategories.aplikasi, ticketCategories.email_website, ticketCategories
                                    .jaringan
                                ],
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Red, Blue, Yellow
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 15,
                                        padding: 30,
                                    }
                                }
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                }
                            }
                        }
                    });

                    // Bar Chart for Categories
                    const ctxBar2 = document.getElementById('barChart2').getContext('2d');
                    const barChart2 = new Chart(ctxBar2, {
                        type: 'bar',
                        data: {
                            labels: ['Aplikasi', 'Email/Website', 'Jaringan/Internet'],
                            datasets: [{
                                label: 'Ticket Count by Category',
                                data: [ticketCategories.aplikasi, ticketCategories.email_website, ticketCategories
                                    .jaringan
                                ],
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Red, Blue, Yellow
                            }]
                        },
                        options: {
                            indexAxis: 'y', // Horizontal bar chart
                        }
                    });

                    const scheduleData = @json($scheduleData); // Pass the schedule data from the controller

                    // Pie Chart for Schedule Statuses
                    const ctxSchedulePie = document.getElementById('schedulePieChart').getContext('2d');
                    const schedulePieChart = new Chart(ctxSchedulePie, {
                        type: 'pie',
                        data: {
                            labels: ['Pending', 'Ongoing', 'Completed'],
                            datasets: [{
                                data: [scheduleData.pending, scheduleData.ongoing, scheduleData.completed],
                                backgroundColor: ['#FBBF24', '#3B82F6', '#10B981'], // Yellow, Blue, Green
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 15,
                                        padding: 30,
                                    }
                                }
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                }
                            }
                        }
                    });

                    // Bar Chart for Schedule Statuses
                    const ctxScheduleBar = document.getElementById('scheduleBarChart').getContext('2d');
                    const scheduleBarChart = new Chart(ctxScheduleBar, {
                        type: 'bar',
                        data: {
                            labels: ['Pending', 'Ongoing', 'Completed'],
                            datasets: [{
                                label: 'Jadwal Count by Status',
                                data: [scheduleData.pending, scheduleData.ongoing, scheduleData.completed],
                                backgroundColor: ['#FBBF24', '#3B82F6', '#10B981'], // Yellow, Blue, Green
                            }]
                        },
                        options: {
                            indexAxis: 'y', // Horizontal bar chart
                        }
                    });
                </script>
            </div>
    </body>

    </html>
@endsection
