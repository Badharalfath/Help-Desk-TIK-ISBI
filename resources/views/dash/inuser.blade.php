@extends('layouts.homedash')

@section('content')
    <!-- Content -->
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h3 class="text-left text-xl font-semibold mb-2 mt-5">Input Pengguna</h3>
        <hr class="mb-4">

        <form id="userForm" action="{{ route('users.store') }}" method="POST" class="max-w-lg mx-auto p-4">
            @csrf
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kepala" {{ old('role') == 'kepala' ? 'selected' : '' }}>Kepala</option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="button" onclick="confirmData()"
                    class="w-full bg-gray-800 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-600">Submit</button>
            </div>
        </form>
    </div>

    <!-- Modal for confirmation -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h5 class="text-lg font-bold mb-4">Konfirmasi Data</h5>
            <p class="mb-2">Email: <span id="confirmEmail" class="font-semibold"></span></p>
            <p class="mb-2">Nama: <span id="confirmName" class="font-semibold"></span></p>
            <p class="mb-2">Role: <span id="confirmRole" class="font-semibold"></span></p>
            <p class="mb-2">Password: <span id="confirmPassword" class="font-semibold"></span></p>
            <div class="flex justify-end">
                <button class="bg-gray-500 text-white px-4 py-2 rounded mr-2" onclick="closeModal()">Edit</button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="submitForm()">Submit</button>
            </div>
        </div>
    </div>

    <script>
        function confirmData() {
            var email = document.getElementById('email').value;
            var name = document.getElementById('name').value;
            var role = document.getElementById('role').value;
            var password = document.getElementById('password').value;
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
@endsection
