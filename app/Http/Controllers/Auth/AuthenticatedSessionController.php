<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil data user yang sedang login
        $user = $request->user();

        // ==========================================================
        // PERBAIKAN BERDASARKAN DATABASE KAMU
        // Di database kamu, kolom penanda admin bernama 'type'
        // dan isinya adalah tulisan 'admin'
        // ==========================================================
        
        if ($user->type === 'admin') {
            return redirect()->intended('admin/dashboard');
        }

        // Jika kolom 'type' isinya bukan admin, lempar ke dashboard user
        return redirect()->intended('user/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}