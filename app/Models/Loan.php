<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model {
        protected $fillable = [
        'kode_transaksi', 'user_id', 'guru_id', 'tgl_pinjam', 'tgl_kembali_rencana', 
        'tgl_kembali_aktual', 'keperluan', 'status', 'catatan_admin', 'denda', 'status_denda'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function guru() {
        return $this->belongsTo(User::class, 'guru_id');
    }
    public function details() {
        return $this->hasMany(LoanDetail::class);
    }
}