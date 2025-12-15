<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek Role Sesuai Parameter Route
        // Contoh penggunaan di route: middleware('checkRole:admin')
        if (Auth::user()->role == $role) {
            return $next($request);
        }

        // 3. Penanganan "Salah Kamar" (Redirect Logic)
        // Jika user memaksa masuk ke halaman yang bukan haknya, lempar ke dashboard masing-masing.
        
        $userRole = Auth::user()->role;

        if ($userRole == 'admin') {
            return redirect()->route('dashboard'); // Pastikan nama route ini benar ada di web.php
        }
        
        if ($userRole == 'user') {
            return redirect()->route('user.dashboard'); // Pastikan nama route ini benar ada di web.php
        }

        // Default jika role tidak dikenali
        return redirect('/');
    }
}