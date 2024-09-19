{{-- <header class="bg-white fixed top-0 left-64 w-full z-50 shadow-lg backdrop-blur-md p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
    </div>
</header> --}}


<header class="text-gray-600 body-font mt-[-10px]">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <span class="ml-3 text-xl">Welcome, {{ auth()->user()->name }}</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a href="{{ route('logout') }}"
                class="py-2.5 px-5 font-medium uppercase text-gray-800 hover:text-blue-500 border-b-2 border-transparent hover:border-blue-500 relative"
                style="top: -5px;"> <!-- Adjust the 'top' value to move the cursor target upward -->
                Logout
            </a>
        </nav>

    </div>
</header>

<script>
    document.getElementById('scroll-sejarah').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('sejarah-upt').scrollIntoView({
            behavior: 'smooth'
        });
    });

    document.getElementById('scroll-tugas').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('tugas-fungsi-upt').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
