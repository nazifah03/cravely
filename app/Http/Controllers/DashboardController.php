<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


        // Total pesanan hari ini
        $totalPesananHariIni = DB::table('pesanan')
            ->whereDate('tanggal_pesan', $hariIni)
            ->count();


        // Total pendapatan hari ini
        $pendapatanHariIni = DB::table('detail_pesanan')
            ->join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')
            ->join('menu', 'detail_pesanan.id_menu', '=', 'menu.id_menu')
            ->whereDate('pesanan.tanggal_pesan', $hariIni)
            ->sum(DB::raw('menu.harga * detail_pesanan.jumlah')) ?? 0;


        // Jumlah seluruh menu
        $totalMenu = DB::table('menu')
            ->count();


        // 5 transaksi terbaru
        $pesananTerbaru = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('barista', 'pesanan.id_barista', '=', 'barista.id_barista')
            ->select(
                'pesanan.id_pesanan',
                'pesanan.tanggal_pesan',
                'pelanggan.nama as nama_pelanggan',
                'barista.nama as nama_barista'
            )
            ->orderBy('pesanan.id_pesanan', 'desc')
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