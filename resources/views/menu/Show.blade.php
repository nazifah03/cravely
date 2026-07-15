@extends('layouts.app')

@section('title', 'Detail Menu')
@section('page-title', $menu->nama_kopi)

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-lg">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $menu->nama_kopi }}</h2>
                <p class="text-sm text-gray-500">{{ $menu->kategori->nama_kategori ?? '-' }} &bull; {{ $menu->size }}</p>
            </div>
            <a href="{{ route('menu.edit', $menu) }}"
                class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Edit
            </a>
        </div>

        <p class="text-2xl font-bold text-amber-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

        <a href="{{ route('menu.index') }}" class="inline-block mt-6 text-sm text-gray-500 hover:text-amber-600">
            &larr; Kembali ke daftar menu
        </a>
    </div>

@endsection