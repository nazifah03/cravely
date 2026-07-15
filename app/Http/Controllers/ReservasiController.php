<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Reservasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    public function index(): View
    {
        $reservasi = Reservasi::with('pelanggan')->latest('waktu_mulai')->paginate(10);

        return view('reservasi.index', compact('reservasi'));
    }

    public function create(): View
    {
        $pelanggan = Pelanggan::orderBy('nama')->get();

        return view('reservasi.create', compact('pelanggan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_pelanggan' => 'nullable|exists:pelanggan,id_pelanggan',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
        ]);

        $validated['status'] = 'booked';

        Reservasi::create($validated);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibuat.');
    }

    public function show(Reservasi $reservasi): View
    {
        $reservasi->load('pelanggan');

        return view('reservasi.show', compact('reservasi'));
    }

    public function edit(Reservasi $reservasi): View
    {
        return view('reservasi.edit', compact('reservasi'));
    }

    public function update(Request $request, Reservasi $reservasi): RedirectResponse
    {
        $validated = $request->validate([
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'status' => 'required|string|in:booked,selesai,dibatalkan',
        ]);

        $reservasi->update($validated);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservasi $reservasi): RedirectResponse
    {
        $reservasi->delete();

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}