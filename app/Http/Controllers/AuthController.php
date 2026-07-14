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
        // 1. Validasi input dari form (menggunakan posisi)
        $request->validate([
            'posisi'   => 'required|string',
            'password' => 'required|string',
        ], [
            'posisi.required'   => 'Posisi barista wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Hardcode login sementara
        $hardcodedPosisi = 'admin';
        $hardcodedPassword = 'rahasia123';

        if ($request->posisi === $hardcodedPosisi && $request->password === $hardcodedPassword) {
            $barista = Barista::firstOrCreate(
                ['posisi' => $hardcodedPosisi],
                [
                    'nama' => 'Admin Cravely',
                    'shift' => 'Pagi',
                    'password' => Hash::make($hardcodedPassword),
                ]
            );

            Auth::guard('barista')->login($barista, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error posisi
        return back()->withErrors([
            'login_error' => 'Posisi atau password yang Anda masukkan salah.',
        ])->withInput($request->only('posisi'));
    }

    /**
     * Memproses keluar dari sistem (Logout).
     */
    public function logout(Request $request)
    {
        // Keluar dari guard barista
        Auth::guard('barista')->logout();

        // Hancurkan session yang berjalan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Alihkan kembali ke halaman login
        return redirect()->route('login');
    }
}
