@extends('layouts.app')

@section('title', 'Pesanan')
@section('page-title', 'Kelola Pesanan')

@section('content')

    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-500">Daftar transaksi pesanan.</p>
        <a href="{{ route('pesanan.create') }}"
            class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Buat Pesanan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Pelanggan</th>
                    <th class="py-3 px-6">Barista</th>
                    <th class="py-3 px-6">Tanggal</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($pesanan as $item)
                    <tr class="hover:bg-gray-50 transition cursor-pointer"
                        onclick="window.location='{{ route('pesanan.show', $item) }}'">
                        <td class="py-4 px-6 font-medium">#{{ $item->id_pesanan }}</td>
                        <td class="py-4 px-6">{{ $item->pelanggan->nama ?? '-' }}</td>
                        <td class="py-4 px-6">{{ $item->barista->nama ?? '-' }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ $item->tanggal_pesan->translatedFormat('d M Y, H:i') }}</td>
                        <td class="py-4 px-6">
                            @php
                                $statusColor = match($item->status) {
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                    default => 'bg-amber-100 text-amber-800',
                                };
                            @endphp
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium capitalize {{ $statusColor }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right font-medium">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400 italic">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pesanan->links() }}
    </div>

@endsection