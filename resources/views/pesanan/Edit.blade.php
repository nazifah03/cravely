@extends('layouts.app')

@section('title', 'Ubah Status Pesanan')
@section('page-title', 'Ubah Status Pesanan #' . $pesanan->id_pesanan)

@section('content')

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-lg">
        <p class="text-sm text-gray-500 mb-4">
            Pelanggan: <strong>{{ $pesanan->pelanggan->nama ?? '-' }}</strong> &bull;
            Total: <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
        </p>

        <form action="{{ route('pesanan.update', $pesanan) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    @foreach (['pending', 'diproses', 'selesai', 'dibatalkan'] as $status)
                        <option value="{{ $status }}" {{ $pesanan->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Update Status
                </button>
                <a href="{{ route('pesanan.show', $pesanan) }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection