@extends('layouts.homelayout')

@section('content')
<!-- resources/views/faq.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="flex justify-center items-center min-h-screen bg-cover bg-center" style="background-image: url('/path-to-background-image');">
        <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg w-11/12 max-w-2xl">
            <h1 class="text-3xl font-bold mb-6 text-center">Frequently Asked Questions</h1>
            <ul class="space-y-4">
                <li class="bg-gray-200 hover:bg-gray-300 p-4 rounded-lg cursor-pointer" onclick="showAnswer('answer1')">
                    What is a Payment Gateway?
                </li>
                <li class="bg-gray-200 hover:bg-gray-300 p-4 rounded-lg cursor-pointer" onclick="showAnswer('answer2')">
                    Do I need to pay to Instapay when there is no transaction going on in my business?
                </li>
                <li class="bg-gray-200 hover:bg-gray-300 p-4 rounded-lg cursor-pointer" onclick="showAnswer('answer3')">
                    What platforms does Instapay payment gateway support?
                </li>
                <li class="bg-gray-200 hover:bg-gray-300 p-4 rounded-lg cursor-pointer" onclick="showAnswer('answer4')">
                    Does Instapay provide international payments support?
                </li>
                <li class="bg-gray-200 hover:bg-gray-300 p-4 rounded-lg cursor-pointer" onclick="showAnswer('answer5')">
                    Is there any setup fee or annual maintenance fee that I need to pay regularly?
                </li>
            </ul>

            <div class="mt-6">
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 hidden" id="answer1">
                    <h2 class="text-xl font-semibold mb-2">What is a Payment Gateway?</h2>
                    <p>A payment gateway is an ecommerce service that processes online payments for online as well as offline businesses. Payment gateways help accept payments by transferring key information from their merchant websites to issuing banks, card associations, and online wallet players.</p>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 hidden" id="answer2">
                    <h2 class="text-xl font-semibold mb-2">Do I need to pay to Instapay when there is no transaction going on in my business?</h2>
                    <p>...</p>
                </div>

                <!-- Add more answers similarly -->
            </div>

            <div class="text-center mt-8 text-sm text-gray-600">
                Didn’t find what you were looking for? <a href="{{ route('complaint') }}" class="text-blue-500 underline">Click here</a> for further assistance.
            </div>
        </div>
    </div>

    <script>
        function showAnswer(answerId) {
            var answers = document.querySelectorAll('.bg-gray-100');
            answers.forEach(function(answer) {
                answer.classList.add('hidden');
            });

            document.getElementById(answerId).classList.remove('hidden');
        }
    </script>
</body>
</html>

