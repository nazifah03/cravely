<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Barista;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses data login yang dikirim berdasarkan Posisi Barista.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'posisi'   => 'required|string',
            'password' => 'required|string',
        ], [
            'posisi.required'   => 'Posisi barista wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Cari barista berdasarkan posisi (case-insensitive)
        $barista = Barista::whereRaw('LOWER(posisi) = ?', [strtolower($request->posisi)])->first();

        // 3. Cek apakah data ditemukan dan password cocok (hashed check, bukan hardcode)
        if ($barista && Hash::check($request->password, $barista->password)) {
            Auth::guard('barista')->login($barista, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'login_error' => 'Posisi atau password yang Anda masukkan salah.',
        ])->withInput($request->only('posisi'));
    }

    /**
     * Memproses keluar dari sistem (Logout).
     */
    public function logout(Request $request)
    {
        Auth::guard('barista')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}