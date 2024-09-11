@extends('layouts.homedash')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div class="text-xl font-bold">Dashboard Admin</div>
            <div>
                <a href="#" class="text-gray-300 hover:text-white px-3">Home</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Profile</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Settings</a>
                <a href="#" class="text-gray-300 hover:text-white px-3">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-1/5 bg-gray-800 p-5">
            <ul class="space-y-6">
                <li><a href="#" class="text-gray-300 hover:text-white">Dashboard</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Kelola Jadwal</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Daftar Tiket</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Input User</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Form FAQ</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="w-4/5 p-10 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-5">Input User</h2>

            <!-- Flash message after user creation -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form id="userForm" method="POST" action="{{ route('users.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role" required>
                        <option value=" - "> - </option>
                        <option value="admin">Admin</option>
                        <option value="kepala">Kepala</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="confirmData()">Submit</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h5 class="text-lg font-bold mb-4">Konfirmasi Data</h5>
            <p class="mb-2">Email: <span id="confirmEmail" class="font-semibold"></span></p>
            <p class="mb-2">Nama: <span id="confirmName" class="font-semibold"></span></p>
            <p class="mb-2">Role: <span id="confirmRole" class="font-semibold"></span></p>
            <p class="mb-2">Password: <span id="confirmPassword" class="font-semibold"></span></p>
            <div class="flex justify-end">
                <button class="bg-gray-500 text-white px-4 py-2 rounded mr-2" onclick="closeModal()">Tidak</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="submitForm()">Ya</button>
            </div>
        </div>
    </div>

    <script>
    function confirmData() {
        var email = document.getElementById('email').value;
        var name = document.getElementById('name').value;
        var role = document.getElementById('role').value;
        var password = document.getElementById('password').value;

        // Buat password sebagai bintang (*) sebanyak jumlah karakter password
        var maskedPassword = '*'.repeat(password.length);

        document.getElementById('confirmEmail').innerText = email;
        document.getElementById('confirmName').innerText = name;
        document.getElementById('confirmRole').innerText = role;
        document.getElementById('confirmPassword').innerText = maskedPassword;

        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function submitForm() {
        document.getElementById('userForm').submit();
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/ui"></script>
</body>
</html>
