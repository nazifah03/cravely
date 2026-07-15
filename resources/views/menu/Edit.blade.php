@extends('layouts.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-lg">
        <form action="{{ route('menu.update', $menu) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kopi</label>
                <input type="text" name="nama_kopi" value="{{ old('nama_kopi', $menu->nama_kopi) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                @error('nama_kopi')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="id_kategori"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}"
                            {{ old('id_kategori', $menu->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                <select name="size"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    @foreach (['Small', 'Medium', 'Large'] as $size)
                        <option value="{{ $size }}" {{ old('size', $menu->size) == $size ? 'selected' : '' }}>{{ $size }}</option>
                    @endforeach
                </select>
                @error('size')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="harga" step="0.01" min="0" value="{{ old('harga', $menu->harga) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                @error('harga')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Update
                </button>
                <a href="{{ route('menu.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection