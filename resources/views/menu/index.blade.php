@extends('layouts.app')

@section('title', 'Menu')
@section('page-title', 'Kelola Menu')

@section('content')

    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-500">Daftar menu yang tersedia.</p>
        <a href="{{ route('menu.create') }}"
            class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Tambah Menu
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">Nama Menu</th>
                    <th class="py-3 px-6">Kategori</th>
                    <th class="py-3 px-6">Size</th>
                    <th class="py-3 px-6">Harga</th>
                    <th class="py-3 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($menu as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $item->nama_kopi }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-full">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">{{ $item->size }}</td>
                        <td class="py-4 px-6">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('menu.edit', $item) }}"
                                class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Edit</a>
                            <form action="{{ route('menu.destroy', $item) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 italic">Belum ada menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection