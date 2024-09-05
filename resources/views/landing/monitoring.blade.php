@extends('layouts.homelayout')

@section('content')
<!-- resources/views/complaint.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
            <main class="w-screen pt-24 px-0">
                <div class="relative w-full h-[100vh]"> <!-- Gunakan h-[80vh] atau ukuran tinggi sesuai kebutuhan -->
                    <iframe src="https://www.isbi.ac.id" frameborder="0" class="absolute top-0 left-0 w-full h-full"></iframe>
                </div>
            </main>
            <!-- <div class="flex flex-col md:flex-row justify-center mt-32 mb-[50px]">
                <img src="https://cdn.buttercms.com/G1BYRHFSEOCwmoS6lP1A" alt="">
            </div> -->

    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>

</html>