<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cravely Dashboard - Pengelola</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col justify-between">

            <div>

                <!-- Logo -->
                <div class="p-6 border-b border-gray-800">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-12 h-12 rounded-xl bg-amber-500 flex items-center justify-center text-2xl shadow-lg">
                            ☕
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold tracking-wide text-amber-400">
                                CRAVELY
                            </h1>

                            <p class="text-xs text-gray-400">
                                Coffee Shop Management
                            </p>
                        </div>

                    </div>

                </div>

                <!-- Menu -->
                <nav class="p-4">

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 py-3 px-4 rounded-xl bg-amber-600 text-white font-semibold shadow hover:bg-amber-700 transition-all duration-300">
                    <span>🏠</span>
                    Dashboard
                </a>

                <!-- Master Data -->
                <p class="text-xs uppercase text-gray-500 mt-8 mb-2 px-2 tracking-widest">
                    Master Data
                </p>

                <a href="{{ route('kategori.index') }}"
                    class="flex items-center gap-3 py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-300">
                    <span>📂</span>
                    Kategori
                </a>

                <a href="{{ route('menu.index') }}"
                    class="flex items-center gap-3 py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-300">
                    <span>☕</span>
                    Menu Kopi
                </a>

                <!-- Transaksi -->
                <p class="text-xs uppercase text-gray-500 mt-8 mb-2 px-2 tracking-widest">
                    Transaksi
                </p>

                <a href="#"
                    class="flex items-center gap-3 py-3 px-4 rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-300">
                    <span>🛒</span>
                    Pesanan
                </a>

            </nav>

            </div>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-xl font-semibold shadow-lg transition-all duration-300">
                    🚪 Keluar (Logout)
                </button>
                </form>
            </div>

        </div>

        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Header -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">

                <h1 class="text-xl font-semibold text-gray-800">
                    Ringkasan Aktivitas
                </h1>

                <div class="flex items-center space-x-3">

                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">
                            {{ $baristaAktif->nama }}
                        </p>

                        <p class="text-xs text-amber-600 font-medium">
                            {{ $baristaAktif->posisi }}
                            (Shift: {{ $baristaAktif->shift }})
                        </p>
                    </div>

                    <div
                        class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($baristaAktif->nama, 0, 2)) }}
                    </div>

                </div>

            </header>

            <!-- Main -->
            <main class="p-6 space-y-6">

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div
                        class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">
                                Pesanan Hari Ini
                            </p>

                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $totalPesananHariIni }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-100 rounded-full text-blue-500 text-xl">
                            🛒
                        </div>

                    </div>

                    <div
                        class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500 flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">
                                Pendapatan Hari Ini
                            </p>

                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="p-3 bg-green-100 rounded-full text-green-500 text-xl">
                            💰
                        </div>

                    </div>

                    <div
                        class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500 flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">
                                Total Menu
                            </p>

                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $totalMenu ?? 0 }}
                            </p>
                        </div>

                        <div class="p-3 bg-amber-100 rounded-full text-amber-500 text-xl">
                            ☕
                        </div>

                    </div>

                </div>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h2 class="font-semibold text-gray-800">
                            5 Transaksi Pesanan Terbaru
                        </h2>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full text-left border-collapse">

                            <thead>

                                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                                    <th class="py-3 px-6">ID Pesanan</th>
                                    <th class="py-3 px-6">Nama Pelanggan</th>
                                    <th class="py-3 px-6">Barista</th>
                                    <th class="py-3 px-6">Tanggal</th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                                @forelse($pesananTerbaru as $pesanan)

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="py-4 px-6 font-medium">
                                            #{{ $pesanan->id_pesanan }}
                                        </td>

                                        <td class="py-4 px-6">
                                            {{ $pesanan->nama_pelanggan }}
                                        </td>

                                        <td class="py-4 px-6">
                                            <span
                                                class="bg-amber-100 text-amber-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                                {{ $pesanan->nama_barista }}
                                            </span>
                                        </td>

                                        <td class="py-4 px-6 text-gray-500">
                                            {{ $pesanan->tanggal_pesan }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-400 italic">
                                            Belum ada transaksi pesanan hari ini.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </main>

        </div>

    </div>

</body>

</html>