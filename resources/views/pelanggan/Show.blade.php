@extends('layouts.app')

@section('title', 'Detail Pelanggan')
@section('page-title', $pelanggan->nama)

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $pelanggan->nama }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $pelanggan->email ?? '-' }} &bull; {{ $pelanggan->telepon ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $pelanggan->alamat ?? 'Alamat belum diisi' }}</p>
            </div>
            <a href="{{ route('pelanggan.edit', $pelanggan) }}"
                class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Edit
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="font-semibold text-gray-800">Riwayat Pesanan</h2>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Tanggal</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($pelanggan->pesanan as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6">
                            <a href="{{ route('pesanan.show', $item) }}" class="hover:text-amber-600 font-medium">
                                #{{ $item->id_pesanan }}
                            </a>
                        </td>
                        <td class="py-4 px-6">{{ $item->tanggal_pesan->translatedFormat('d M Y, H:i') }}</td>
                        <td class="py-4 px-6 capitalize">{{ $item->status }}</td>
                        <td class="py-4 px-6 text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400 italic">Belum ada riwayat pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('pelanggan.index') }}" class="inline-block mt-6 text-sm text-gray-500 hover:text-amber-600">
        &larr; Kembali ke daftar pelanggan
    </a>

@endsection