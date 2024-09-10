<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="flex">

        @include('layouts.partial.navdash')

        <div class="flex-grow ml-64">
            <!-- Header -->
            <header class="bg-white fixed top-0 left-64 w-full z-50 shadow-lg backdrop-blur-md p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-bold">Dashboard</h1>
                    <div>
                        <!-- Add any header icons or links here -->
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-4 mt-16">
                @yield('content')
            </main>

            @include('layouts.partial.footer')
        </div>
    </body>
</html>
