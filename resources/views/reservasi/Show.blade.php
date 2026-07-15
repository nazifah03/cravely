@extends('layouts.app')

@section('title', 'Detail Reservasi')
@section('page-title', 'Detail Reservasi')

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-lg">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $reservasi->pelanggan->nama ?? 'Tanpa nama pelanggan' }}</h2>
                <p class="text-sm text-gray-500 mt-1 capitalize">Status: {{ $reservasi->status }}</p>
            </div>
            <a href="{{ route('reservasi.edit', $reservasi) }}"
                class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Edit
            </a>
        </div>

        <div class="text-sm space-y-2">
            <p><span class="text-gray-500">Waktu Mulai:</span> {{ $reservasi->waktu_mulai->translatedFormat('d M Y, H:i') }}</p>
            <p><span class="text-gray-500">Waktu Selesai:</span> {{ $reservasi->waktu_selesai?->translatedFormat('d M Y, H:i') ?? '-' }}</p>
        </div>

        <a href="{{ route('reservasi.index') }}" class="inline-block mt-6 text-sm text-gray-500 hover:text-amber-600">
            &larr; Kembali ke daftar reservasi
        </a>
    </div>

@endsection