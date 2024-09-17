<header class="bg-white fixed top-0 left-64 w-full z-50 shadow-lg backdrop-blur-md p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Help Desk Admin</h1>
        <div class="pr-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
