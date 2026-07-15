@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Ringkasan Aktivitas')

@section('content')

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Pesanan Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPesananHariIni }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-blue-500 text-xl">🛒</div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Pendapatan Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">
                    Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                </p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-500 text-xl">💰</div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Menu</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalMenu ?? 0 }}</p>
            </div>
            <div class="p-3 bg-amber-100 rounded-full text-amber-500 text-xl">☕</div>
        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="font-semibold text-gray-800">5 Transaksi Pesanan Terbaru</h2>
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
                    @forelse ($pesananTerbaru as $pesanan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">#{{ $pesanan->id_pesanan }}</td>
                            <td class="py-4 px-6">{{ $pesanan->pelanggan->nama ?? '-' }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-amber-100 text-amber-800 text-xs px-2.5 py-1 rounded-full font-medium">
                                    {{ $pesanan->barista->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-500">
                                {{ $pesanan->tanggal_pesan->translatedFormat('d M Y, H:i') }}
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

@endsection