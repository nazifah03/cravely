<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cravely Dashboard') - Cravely Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    @php
        $baristaAktif = Auth::guard('barista')->user();
    @endphp

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col justify-between">

            <div>
                <!-- Logo -->
                <div class="p-6 border-b border-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-500 flex items-center justify-center text-2xl shadow-lg">
                            
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold tracking-wide text-amber-400">CRAVELY</h1>
                            <p class="text-xs text-gray-400">Coffee Shop Management</p>
                        </div>
                    </div>
                </div>

                <!-- Menu -->
                <nav class="p-4">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 font-semibold transition-all duration-300
                            {{ request()->routeIs('dashboard') ? 'bg-amber-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Dashboard
                    </a>

                    @if ($baristaAktif && $baristaAktif->isAdmin())
                        <p class="text-xs uppercase text-gray-500 mt-8 mb-2 px-2 tracking-widest">Master Data</p>

                        <a href="{{ route('kategori.index') }}"
                            class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                                {{ request()->routeIs('kategori.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            Kategori
                        </a>

                        <a href="{{ route('menu.index') }}"
                            class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                                {{ request()->routeIs('menu.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            Menu
                        </a>
                    @endif

                    <p class="text-xs uppercase text-gray-500 mt-8 mb-2 px-2 tracking-widest">Transaksi</p>

                    <a href="{{ route('pesanan.index') }}"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                            {{ request()->routeIs('pesanan.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Pesanan
                    </a>

                    <a href="{{ route('pelanggan.index') }}"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                            {{ request()->routeIs('pelanggan.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Pelanggan
                    </a>

                    <a href="{{ route('reservasi.index') }}"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                            {{ request()->routeIs('reservasi.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Reservasi
                    </a>

                    <p class="text-xs uppercase text-gray-500 mt-8 mb-2 px-2 tracking-widest">Akun</p>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl mb-1 transition-all duration-300
                            {{ request()->routeIs('profile.*') ? 'bg-amber-600 text-white shadow font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        Profile Saya
                    </a>

                </nav>
            </div>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-xl font-semibold shadow-lg transition-all duration-300">
                        Keluar
                    </button>
                </form>
            </div>

        </div>

        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Header -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>

                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">{{ $baristaAktif->nama }}</p>
                        <p class="text-xs text-amber-600 font-medium">
                            {{ $baristaAktif->posisi }}
                            @if ($baristaAktif->shift)
                                (Shift: {{ $baristaAktif->shift }})
                            @endif
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($baristaAktif->nama, 0, 2)) }}
                    </div>
                </div>
            </header>

            @if (session('success'))
                <div class="mx-6 mt-4 p-3 bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Main -->
            <main class="p-6 space-y-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>