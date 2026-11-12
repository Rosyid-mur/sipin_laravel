<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
        // Di method proses (setelah Auth::attempt berhasil)
        ActivityLog::record('Login', 'Berhasil masuk ke sistem sebagai ' . Auth::user()->role);
    }

        public function proses(Request $request) {
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,guru,siswa'], // Validasi role
        ]);

        // 2. Coba Login dengan mencocokkan Username, Password, DAN Role
        if (Auth::attempt([
            'username' => $request->username, 
            'password' => $request->password,
            'role' => $request->role
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika gagal, berikan pesan error yang sesuai
        return back()->withErrors([
            'username' => 'Kredensial salah atau Role yang Anda pilih tidak cocok dengan akun ini.',
        ])->onlyInput('username');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // Di method proses (setelah Auth::attempt berhasil)
        ActivityLog::record('Login', 'Berhasil masuk ke sistem sebagai ' . Auth::user()->role);
    }
}