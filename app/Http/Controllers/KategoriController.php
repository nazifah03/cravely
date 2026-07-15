<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        // withCount('menu') menghitung jumlah menu per kategori dalam satu query,
        // supaya tidak N+1 query saat ditampilkan di view (bukan lazy-load per baris).
        $kategori = Kategori::withCount('menu')->orderBy('nama_kategori')->get();

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori beserta menu di dalamnya.
     */
    public function show(Kategori $kategori)
    {
        $kategori->load('menu');

        return view('kategori.show', compact('kategori'));
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Mengupdate kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
        ], [
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori.
     * Menu yang terkait ikut terhapus (cascadeOnDelete sudah diatur di migration).
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}