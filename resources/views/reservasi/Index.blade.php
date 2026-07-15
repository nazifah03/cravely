@extends('layouts.app')

@section('title', 'Reservasi')
@section('page-title', 'Kelola Reservasi')

@section('content')

    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-500">Daftar reservasi tempat.</p>
        <a href="{{ route('reservasi.create') }}"
            class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Tambah Reservasi
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">Pelanggan</th>
                    <th class="py-3 px-6">Waktu Mulai</th>
                    <th class="py-3 px-6">Waktu Selesai</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($reservasi as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $item->pelanggan->nama ?? 'Tanpa nama' }}</td>
                        <td class="py-4 px-6">{{ $item->waktu_mulai->translatedFormat('d M Y, H:i') }}</td>
                        <td class="py-4 px-6">{{ $item->waktu_selesai?->translatedFormat('d M Y, H:i') ?? '-' }}</td>
                        <td class="py-4 px-6">
                            @php
                                $statusColor = match($item->status) {
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                    default => 'bg-amber-100 text-amber-800',
                                };
                            @endphp
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium capitalize {{ $statusColor }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('reservasi.edit', $item) }}"
                                class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Edit</a>
                            <form action="{{ route('reservasi.destroy', $item) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus reservasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 italic">Belum ada reservasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reservasi->links() }}
    </div>

@endsection
