<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login admin.
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Memproses login admin.
     */
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Memeriksa email dan password di database
        if (Auth::attempt($credentials)) {
            // Membuat ulang session untuk keamanan
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        // Jika email atau password salah
        return back()
            ->withErrors([
                'email' => 'Email atau password yang dimasukkan salah.',
            ])
            ->onlyInput('email');
    }

    /**
     * Mengeluarkan admin dari sistem.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus session login
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
}