@extends('layouts.homedash')

@section('content')
    <div class="bg-gray-100 rounded-lg shadow-md max-w-lg mx-auto p-4 px-8 mt-10">
        <h2 class="text-left text-xl font-semibold mb-2 mt-5">Input FAQ</h2>
        <hr class="mb-4">

        <!-- Form FAQ -->
        <form action="{{ route('formfaq.store') }}" method="POST" class="max-w-lg mx-auto p-4">
            @csrf

            <!-- Bidang Permasalahan -->
            <div class="mb-4">
                <label for="bidang_permasalahan" class="block text-sm font-medium text-gray-700">Bidang Permasalahan</label>

                <div class="flex space-x-4">
                    <!-- First input field -->
                    <input type="text" id="bidang_permasalahan" name="bidang_permasalahan"
                        class="mt-1 block w-1/2 border border-gray-300 rounded-md shadow-sm p-2" required>

                    <!-- Second dropdown field -->
                    <select id="dropdown_bidang_permasalahan" name="dropdown_bidang_permasalahan"
                        class="mt-1 block w-1/2 border border-gray-300 rounded-md shadow-sm p-2"
                        onchange="setBidangPermasalahanValue()">
                        <option value="">Pilih Bidang Permasalahan</option>
                        @foreach ($bidangPermasalahanOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nama Masalah -->
            <div class="mb-4">
                <label for="nama_masalah" class="block text-sm font-medium text-gray-700">Nama Masalah</label>
                <input type="text" id="nama_masalah" name="nama_masalah"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <!-- Deskripsi Penyelesaian Masalah -->
            <div class="mb-4">
                <label for="deskripsi_penyelesaian_masalah" class="block text-sm font-medium text-gray-700">Deskripsi Penyelesaian Masalah</label>
                <textarea id="deskripsi_penyelesaian_masalah" name="deskripsi_penyelesaian_masalah" rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Submit</button>
            </div>
        </form>

        <script>
            // This function sets the value of the first input field to the selected value from the dropdown
            function setBidangPermasalahanValue() {
                const dropdown = document.getElementById('dropdown_bidang_permasalahan');
                const selectedValue = dropdown.options[dropdown.selectedIndex].value;
                document.getElementById('bidang_permasalahan').value = selectedValue;
            }
        </script>
    </div>
@endsection
