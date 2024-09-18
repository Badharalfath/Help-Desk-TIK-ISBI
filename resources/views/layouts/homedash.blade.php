<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>Dashboard</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="min-h-screen flex flex-col bg-gray-200">

        @include('layouts.partial.sidebar')

        <!-- Main content container -->
        <div class="flex-grow flex flex-col ml-64 ">
            @include('layouts.partial.navdash')

            <!-- Main Content -->
            <main class="flex-grow p-4 mt-6 mt-[-50px]">
                @yield('content')
            </main>

            @include('layouts.partial.footer')
        </div>
    </body>
</html>
