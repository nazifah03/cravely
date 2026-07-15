<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $barista = Auth::guard('barista')->user();

        return view('profile.edit', compact('barista'));
    }

    public function update(Request $request): RedirectResponse
    {
        $barista = Auth::guard('barista')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'shift' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $barista->nama = $validated['nama'];
        $barista->shift = $validated['shift'] ?? $barista->shift;

        if (!empty($validated['password'])) {
            // Cast 'password' => 'hashed' di model Barista otomatis hash ini saat disimpan.
            $barista->password = $validated['password'];
        }
    
        $barista->save();

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}