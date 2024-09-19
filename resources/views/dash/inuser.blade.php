@extends('layouts.homedash')

@section('content')
    <!-- Content -->
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-800 p-6">
                <h3 class="text-white text-lg font-semibold">Form FAQ</h3>
            </div>


            <form id="userForm" action="{{ route('users.store') }}" method="POST" class="p-8">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kepala" {{ old('role') == 'kepala' ? 'selected' : '' }}>Kepala</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" name="password" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm
                        Password:</label>
                    <input type="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="button" onclick="confirmData()"
                    class="w-full py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-gray-800 rounded-full border border-gray-200 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Submit
                </button>

            </form>
        </div>
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
            // Ambil nilai dari input form
            var email = document.getElementById('email').value;
            var name = document.getElementById('name').value;
            var role = document.getElementById('role').value;
            var password = document.getElementById('password').value;

            // Buat password sebagai bintang (*) sebanyak jumlah karakter password
            var maskedPassword = '*'.repeat(password.length);

            // Isi nilai pada modal
            document.getElementById('confirmEmail').innerText = email;
            document.getElementById('confirmName').innerText = name;
            document.getElementById('confirmRole').innerText = role;
            document.getElementById('confirmPassword').innerText = maskedPassword;

            // Tampilkan modal
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeModal() {
            // Tutup modal
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitForm() {
            // Submit form
            document.getElementById('userForm').submit();
        }
    </script>
    </body>

    </html>
@endsection
