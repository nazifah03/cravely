<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PesananController extends Controller
{
    /**
     * Tarif PPN yang dipakai untuk perhitungan struk.
     * Diletakkan sebagai konstanta supaya mudah diubah di satu tempat saja.
     */
    private const TARIF_PAJAK = 0.11; // PPN 11%

    public function index(): View
    {
        $pesanan = Pesanan::with(['pelanggan', 'barista'])->latest()->paginate(10);

        return view('pesanan.index', compact('pesanan'));
    }

    public function create(): View
    {
        $pelanggan = Pelanggan::orderBy('nama')->get();
        $menu = Menu::with('kategori')->orderBy('nama_kopi')->get();

        return view('pesanan.create', compact('pelanggan', 'menu'));
    }

    /**
     * Simpan pesanan baru beserta detail item-nya sekaligus.
     * Total = subtotal item + PPN 11%, dihitung otomatis dari harga menu saat itu.
     * Setelah tersimpan, langsung diarahkan ke halaman struk (bukan halaman detail biasa).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'items' => 'required|array|min:1',
            'items.*.id_menu' => 'required|exists:menu,id_menu',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $pesanan = DB::transaction(function () use ($validated) {
            $subtotal = 0;
            $itemsWithHarga = [];

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['id_menu']);
                $subtotalItem = $menu->harga * $item['jumlah'];
                $subtotal += $subtotalItem;

                $itemsWithHarga[] = [
                    'id_menu' => $menu->id_menu,
                    'jumlah' => $item['jumlah'],
                    'harga' => $menu->harga,
                ];
            }

            $pajak = round($subtotal * self::TARIF_PAJAK);
            $total = $subtotal + $pajak;

            $pesanan = Pesanan::create([
                'id_pelanggan' => $validated['id_pelanggan'],
                'id_barista' => Auth::guard('barista')->id(),
                'tanggal_pesan' => now(),
                'total' => $total,
                'status' => 'pending',
            ]);

            $pesanan->detailPesanan()->createMany($itemsWithHarga);

            return $pesanan;
        });

        return redirect()->route('pesanan.struk', $pesanan)
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(Pesanan $pesanan): View
    {
        $pesanan->load(['pelanggan', 'barista', 'detailPesanan.menu']);

        return view('pesanan.show', compact('pesanan'));
    }

    /**
     * Halaman struk/bill pesanan —  ditampilkan dan dicetak,
     * terpisah dari layout dashboard (tanpa sidebar).
     */
    public function struk(Pesanan $pesanan): View
    {
        $pesanan->load(['pelanggan', 'barista', 'detailPesanan.menu']);

        $subtotal = $pesanan->detailPesanan->sum(fn ($item) => $item->harga * $item->jumlah);
        $pajak = $pesanan->total - $subtotal;

        return view('pesanan.struk', compact('pesanan', 'subtotal', 'pajak'));
    }

    public function edit(Pesanan $pesanan): View
    {
        return view('pesanan.edit', compact('pesanan'));
    }

    /** perbaikan status
     * (mis. pending -> diproses -> selesai), bukan ubah item.
     */
    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,diproses,selesai,dibatalkan',
        ]);

        $pesanan->update($validated);

        return redirect()->route('pesanan.show', $pesanan)->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}