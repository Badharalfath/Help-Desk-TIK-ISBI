@extends('layouts.homelayout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white text-gray-800 font-sans">

    <div class="mt-24 mb-[50px]">
        <!-- Header Section -->
        <section class="text-center bg-gray-50 py-16 ">
            <h1 class="text-4xl font-bold mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600">Cari jawaban yang biasa ditanyakan oleh banyak orang disini.</p>
        </section>

        <!-- FAQ Section -->
        <section class="container mx-auto max-w-4xl px-6 py-8">
            <div>
                <!-- FAQ Item Internet & Jaringan-->
                <div class="divide-y divide-gray-200 mt-[80px]">
                    <h1 id="internet_jaringan" class="text-center font-bold text-3xl mb-[30px]">Internet & Jaringan</h1>
                    @foreach($faqsIT as $faq)
                        <div class="py-4">
                            <button class="flex justify-between w-full text-left text-gray-800 font-medium text-lg py-4"
                                onclick="toggleFaq('faq{{ $faq->id }}')">
                                <span>{{ $faq->nama_masalah }}</span>
                                <svg class="w-6 h-6 transform transition-transform duration-300" id="faq{{ $faq->id }}-icon"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Konten FAQ tanpa simbol -->
                            <div class="text-gray-600 hidden transition-opacity duration-300" id="faq{{ $faq->id }}">
                                @foreach(explode("\n", $faq->deskripsi_penyelesaian_masalah) as $point)
                                    <div>{{ $point }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- FAQ Item Aplikasi & Email -->
                <div class="divide-y divide-gray-200 mt-[80px]">
                    <h1 id="aplikasi_email" class="text-center font-bold text-3xl mb-[30px]">Aplikasi & Email</h1>
                    @foreach($faqsApps as $faq)
                        <div class="py-4">
                            <button class="flex justify-between w-full text-left text-gray-800 font-medium text-lg py-4"
                                onclick="toggleFaq('faq{{ $faq->id }}')">
                                <span>{{ $faq->nama_masalah }}</span>
                                <svg class="w-6 h-6 transform transition-transform duration-300" id="faq{{ $faq->id }}-icon"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Konten FAQ tanpa simbol -->
                            <div class="text-gray-600 hidden transition-opacity duration-300 whitespace-pre-wrap break-words my-[-50px]" id="faq{{ $faq->id }}">
                                @foreach(explode("\n", $faq->deskripsi_penyelesaian_masalah) as $point)
                                    <div>{{ $point }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Assistance Section -->
            <div class="mt-12 text-center">
                <p class="text-gray-600 text-lg">Didn’t find what you were looking for?</p>
                <a href="{{ route('complaint') }}" class="text-blue-500 font-medium hover:underline">Contact us for
                    further assistance</a>
            </div>
        </section>

        <!-- JavaScript for toggling FAQs -->
        <script>
            function toggleFaq(faqId) {
                var answer = document.getElementById(faqId);
                var icon = document.getElementById(faqId + '-icon');

                if (answer.classList.contains('hidden')) {
                    answer.classList.remove('hidden');
                    answer.style.opacity = 0;
                    setTimeout(() => {
                        answer.style.opacity = 1;
                    }, 10);
                    icon.classList.add('rotate-180');
                } else {
                    answer.style.opacity = 0;
                    setTimeout(() => {
                        answer.classList.add('hidden');
                    }, 300);
                    icon.classList.remove('rotate-180');
                }
            }

            // Scroll functions for Internet & Jaringan and Aplikasi & Email
            document.getElementById('scroll-internet').addEventListener('click', function (event) {
                event.preventDefault(); 

                if (window.location.pathname.includes('/faq')) {
                    var targetElement = document.getElementById('internet_jaringan');
                    var offset = 150;

                    var elementPosition = targetElement.getBoundingClientRect().top;
                    var offsetPosition = elementPosition + window.pageYOffset - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                } else {
                    window.location.href = "{{ route('faq') }}#internet_jaringan";
                }
            });

            document.getElementById('scroll-aplikasi-email').addEventListener('click', function (event) {
                event.preventDefault(); 

                if (window.location.pathname.includes('/faq')) {
                    var targetElement = document.getElementById('aplikasi_email');
                    var offset = 150; 

                    var elementPosition = targetElement.getBoundingClientRect().top;
                    var offsetPosition = elementPosition + window.pageYOffset - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                } else {
                    window.location.href = "{{ route('faq') }}#aplikasi_email";
                }
            });

        </script>

    </div>

</body>

</html>
@endsection
