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
    <div class="flex flex-col md:flex-row justify-center " style="background-image: url('/path-to-background-image');">
        <div class="max-w-7xl mx-auto p-6 mt-28 mb-[50px]">
            <h1 class="text-3xl font-bold mb-6">SELAMAT DATANG</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pie Chart Section -->
                <div class="bg-white shadow rounded-lg p-6">
                    <canvas id="pieChart"></canvas>
                </div>

                <!-- Bar Chart Section -->
                <div class="bg-white shadow rounded-lg p-6">
                    <canvas id="barChart"></canvas>
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
                    labels: ['Unsolved', 'Ongoing', 'Solved'],
                    datasets: [{
                        data: [ticketStatuses.unsolved, ticketStatuses.ongoing, ticketStatuses.solved],
                        backgroundColor: ['#6B7280', '#FBBF24', '#10B981'], // Gray, Yellow, Green
                    }]
                },
            });

            // Bar Chart Data
            const ctxBar = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Unsolved', 'Ongoing', 'Solved'],
                    datasets: [{
                        label: 'Ticket Status Count',
                        data: [ticketStatuses.unsolved, ticketStatuses.ongoing, ticketStatuses.solved],
                        backgroundColor: ['#6B7280', '#FBBF24', '#10B981'], // Gray, Yellow, Green
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