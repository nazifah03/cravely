<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::with('kategori')->get();

        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('menu.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}