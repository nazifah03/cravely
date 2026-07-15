<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::with('kategori')->orderBy('nama_kopi')->get();

        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('menu.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'size' => 'required|in:Small,Medium,Large',
            'id_kategori' => 'required|exists:kategori,id_kategori',
        ]);

        Menu::create($validated);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function show(Menu $menu)
    {
        $menu->load('kategori');

        return view('menu.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('menu.edit', compact('menu', 'kategori'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'size' => 'required|in:Small,Medium,Large',
            'id_kategori' => 'required|exists:kategori,id_kategori',
        ]);

        $menu->update($validated);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}