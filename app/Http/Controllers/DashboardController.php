<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama dashboard pengelola/barista.
     */
    public function index()
    {
        // Data barista yang sedang login
        $baristaAktif = Auth::guard('barista')->user();

        // Tanggal hari ini
        $hariIni = now()->toDateString();

        // Pesanan hari ini, tidak termasuk yang dibatalkan
        $pesananHariIniQuery = Pesanan::whereDate('tanggal_pesan', $hariIni)
            ->where('status', '!=', 'dibatalkan');

        // Total pesanan hari ini
        $totalPesananHariIni = (clone $pesananHariIniQuery)->count();

        // Total pendapatan hari ini — pakai kolom 'total' yang sudah dihitung
        // saat pesanan dibuat (snapshot harga saat itu), bukan harga menu saat ini.
        $pendapatanHariIni = (clone $pesananHariIniQuery)->sum('total');

        // Jumlah seluruh menu
        $totalMenu = Menu::count();

        // 5 transaksi terbaru
        $pesananTerbaru = Pesanan::with(['pelanggan', 'barista'])
            ->latest('id_pesanan')
            ->take(5)
            ->get();

        return view('dashboard.dashboard', compact(
            'baristaAktif',
            'totalPesananHariIni',
            'pendapatanHariIni',
            'totalMenu',
            'pesananTerbaru'
        ));
    }
}