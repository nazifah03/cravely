<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRAVELY</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-amber-900 text-white">

            <div class="text-center py-6 border-b border-amber-700">
                <h1 class="text-3xl font-bold">☕</h1>
                <h2 class="text-xl font-bold mt-2">CRAVELY</h2>
                <p class="text-sm text-amber-200">Coffee Management</p>
            </div>

            <nav class="mt-6">

                <a href="{{ route('dashboard') }}"
                   class="block px-6 py-3 hover:bg-amber-800 transition">
                    Dashboard
                </a>

                <a href="{{ route('menu.index') }}"
                   class="block px-6 py-3 hover:bg-amber-800 transition">
                    Menu
                </a>

                <a href="{{ route('kategori.index') }}"
                   class="block px-6 py-3 hover:bg-amber-800 transition">
                    Kategori
                </a>

            </nav>

        </aside>

        <!-- Content -->
        <main class="flex-1">

            <!-- Navbar -->
            <header class="bg-white shadow">

                <div class="flex justify-between items-center px-8 py-4">

                    <h2 class="text-2xl font-bold text-gray-700">
                        @yield('title')
                    </h2>

                    <div class="flex items-center gap-4">

                        <span class="text-gray-700">
                            {{ Auth::guard('barista')->user()->nama ?? 'Barista' }}
                        </span>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </header>

            <!-- Page Content -->
            <div class="p-8">

                @if(session('success'))
                    <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>

        </main>

    </div>

</body>
</html>