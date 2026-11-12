<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed', // confirmed artinya harus ada input password_confirmation
        ]);

        $data = ['no_hp' => $request->no_hp];

        // Jika user mengisi password baru
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Catat Log
        ActivityLog::record('Update Profil', 'Memperbarui informasi kontak / password');

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}