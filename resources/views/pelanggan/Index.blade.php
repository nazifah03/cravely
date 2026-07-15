@extends('layouts.app')

@section('title', 'Pelanggan')
@section('page-title', 'Kelola Pelanggan')

@section('content')

    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-500">Daftar pelanggan terdaftar.</p>
        <a href="{{ route('pelanggan.create') }}"
            class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Tambah Pelanggan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <th class="py-3 px-6">Nama</th>
                    <th class="py-3 px-6">Email</th>
                    <th class="py-3 px-6">Telepon</th>
                    <th class="py-3 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse ($pelanggan as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">
                            <a href="{{ route('pelanggan.show', $item) }}" class="hover:text-amber-600">
                                {{ $item->nama }}
                            </a>
                        </td>
                        <td class="py-4 px-6">{{ $item->email ?? '-' }}</td>
                        <td class="py-4 px-6">{{ $item->telepon ?? '-' }}</td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('pelanggan.edit', $item) }}"
                                class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Edit</a>
                            <form action="{{ route('pelanggan.destroy', $item) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus pelanggan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400 italic">Belum ada pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pelanggan->links() }}
    </div>

@endsection