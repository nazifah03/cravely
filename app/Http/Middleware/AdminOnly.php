<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Hanya izinkan barista dengan posisi 'Admin' (case-insensitive) untuk lanjut.
     * Selain itu, tolak dengan 403 Forbidden.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $barista = Auth::guard('barista')->user();

        if (!$barista || !$barista->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini. Hubungi Admin.');
        }

        return $next($request);
    }
}