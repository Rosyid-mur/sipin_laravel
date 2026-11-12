<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable {
        protected $fillable = [
    'name', 'username', 'password', 'role', 'kelas', 
    'no_absen', 'mata_pelajaran', 'jabatan', 'unit_kerja', 'status_akun', 'foto_profil', 'no_hp'
];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    // Relasi sebagai peminjam
    public function loans() {
        return $this->hasMany(Loan::class, 'user_id');
    }

     // TAMBAHKAN KODE INI UNTUK FITUR KERANJANG
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    
    // Relasi sebagai guru pembimbing
    public function supervisedLoans() {
        return $this->hasMany(Loan::class, 'guru_id');
    }
}