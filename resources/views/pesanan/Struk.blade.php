<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $pesanan->id_pesanan }} - Cravely Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .struk-box { box-shadow: none !important; border: none !important; }
        }
        body { font-family: 'Courier New', monospace; }
    </style>
</head>
<body class="bg-gray-200 min-h-screen py-8 flex flex-col items-center">

    <div class="no-print mb-4 flex gap-3">
        <button onclick="window.print()"
            class="bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
            🖨️ Cetak Struk
        </button>
        <a href="{{ route('pesanan.show', $pesanan) }}"
            class="bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-lg border border-gray-300 transition">
            Lihat Detail Pesanan
        </a>
        <a href="{{ route('dashboard') }}"
            class="bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-lg border border-gray-300 transition">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="struk-box bg-white w-full max-w-sm shadow-lg rounded-sm p-6 text-sm text-gray-900">

        <!-- Header -->
        <div class="text-center mb-4">
            <p class="text-2xl mb-1">☕</p>
            <h1 class="text-lg font-bold tracking-wide">CRAVELY COFFEE</h1>
            <p class="text-xs text-gray-500">Jl. Senopati. 123, Jakarta</p>
            <p class="text-xs text-gray-500">Telp: (021) 000-0000</p>
        </div>

        <div class="border-t border-dashed border-gray-400 my-3"></div>

        <!-- Info Transaksi -->
        <div class="text-xs space-y-1 mb-3">
            <div class="flex justify-between">
                <span>No. Pesanan</span>
                <span class="font-semibold">#{{ str_pad($pesanan->id_pesanan, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between">
                <span>Tanggal</span>
                <span>{{ $pesanan->tanggal_pesan->translatedFormat('d M Y, H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kasir</span>
                <span>{{ $pesanan->barista->nama ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pelanggan</span>
                <span>{{ $pesanan->pelanggan->nama ?? 'Pelanggan Umum' }}</span>
            </div>
        </div>

        <div class="border-t border-dashed border-gray-400 my-3"></div>

        <!-- Item -->
        <div class="space-y-2 mb-3">
            @foreach ($pesanan->detailPesanan as $item)
                <div>
                    <div class="flex justify-between font-medium">
                        <span>{{ $item->menu->nama_kopi ?? 'Menu telah dihapus' }}</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>{{ $item->jumlah }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span>Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="border-t border-dashed border-gray-400 my-3"></div>

        <!-- Ringkasan -->
        <div class="text-xs space-y-1">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>PPN (11%)</span>
                <span>Rp {{ number_format($pajak, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="border-t border-dashed border-gray-400 my-3"></div>

        <div class="flex justify-between text-base font-bold">
            <span>TOTAL</span>
            <span>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
        </div>

        <div class="border-t border-dashed border-gray-400 my-4"></div>

        <!-- Footer -->
        <div class="text-center text-xs text-gray-500 space-y-1">
            <p>Terima kasih telah Nongki di Cravely Coffee!</p>
            <p>Enjoy☕</p>
        </div>

    </div>

</body>
</html>