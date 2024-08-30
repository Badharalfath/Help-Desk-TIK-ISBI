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
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            const pieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Desktop', 'Mobile', 'Tablets'],
                    datasets: [{
                        data: [8085, 8085, 8085],
                        backgroundColor: ['#4F46E5', '#FB923C', '#22C55E'],
                    }]
                },
            });

            const ctxBar = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Direct', 'Direct', 'Direct'],
                    datasets: [{
                        label: 'Traffic (%)',
                        data: [23.28, 23.28, 23.28],
                        backgroundColor: ['#4F46E5', '#FB923C', '#22C55E'],
                    }]
                },
            });
        </script>
    </div>    
</body>
</html>