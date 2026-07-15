@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori Baru')

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-lg">
        <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    placeholder="Contoh: Coffee, Non-Coffee, Snack">
                @error('nama_kategori')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Simpan
                </button>
                <a href="{{ route('kategori.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection