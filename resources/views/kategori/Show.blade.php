@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('page-title', $kategori->nama_kategori)

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $kategori->nama_kategori }}</h2>
                <p class="text-sm text-gray-500">{{ $kategori->menu->count() }} menu dalam kategori ini</p>
            </div>
            <a href="{{ route('kategori.edit', $kategori) }}"
                class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Edit
            </a>
        </div>

        @if ($kategori->menu->isEmpty())
            <p class="text-sm text-gray-400 italic">Belum ada menu di kategori ini.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-gray-500 border-b">
                        <th class="py-2">Nama Kopi</th>
                        <th class="py-2">Size</th>
                        <th class="py-2 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($kategori->menu as $item)
                        <tr>
                            <td class="py-3">{{ $item->nama_kopi }}</td>
                            <td class="py-3">{{ $item->size }}</td>
                            <td class="py-3 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('kategori.index') }}" class="inline-block mt-6 text-sm text-gray-500 hover:text-amber-600">
            &larr; Kembali ke daftar kategori
        </a>
    </div>

@endsection