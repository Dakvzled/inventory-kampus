<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pastikan User Login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role-nya 'admin' (Gunakan 'role', bukan 'type')
        if (Auth::user()->role == 'admin') {
            return $next($request);
        }

        // 3. Jika User login tapi BUKAN admin, jangan kasih error 401 (layar putih).
        // Lebih baik lempar balik ke dashboard User agar lebih ramah.
        return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses admin!');
        
        // OPSI ALTERNATIF: Jika Anda tetap ingin memunculkan error 401/403 (Forbidden):
        // abort(403, 'Akses Ditolak. Halaman ini khusus Admin.');
    }
}