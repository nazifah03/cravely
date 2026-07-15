@extends('layouts.app')

@section('title', 'Detail Pesanan')
@section('page-title', 'Pesanan #' . $pesanan->id_pesanan)

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Pesanan #{{ $pesanan->id_pesanan }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $pesanan->tanggal_pesan->translatedFormat('d M Y, H:i') }}</p>
            </div>
            <a href="{{ route('pesanan.edit', $pesanan) }}"
                class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Ubah Status
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Pelanggan</p>
                <p class="font-medium text-gray-800">{{ $pesanan->pelanggan->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Barista</p>
                <p class="font-medium text-gray-800">{{ $pesanan->barista->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status</p>
                <p class="font-medium text-gray-800 capitalize">{{ $pesanan->status }}</p>
            </div>
            <div>
                <p class="text-gray-500">Total</p>
                <p class="font-bold text-amber-600">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="font-semibold text-gray-800">Rincian Item</h2>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">Menu</th>
                    <th class="py-3 px-6">Jumlah</th>
                    <th class="py-3 px-6">Harga Satuan</th>
                    <th class="py-3 px-6 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @foreach ($pesanan->detailPesanan as $item)
                    <tr>
                        <td class="py-3 px-6">{{ $item->menu->nama_kopi ?? 'Menu telah dihapus' }}</td>
                        <td class="py-3 px-6">{{ $item->jumlah }}</td>
                        <td class="py-3 px-6">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-right">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('pesanan.index') }}" class="inline-block mt-6 text-sm text-gray-500 hover:text-amber-600">
        &larr; Kembali ke daftar pesanan
    </a>

@endsection