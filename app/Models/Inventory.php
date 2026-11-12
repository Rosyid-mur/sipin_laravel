<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {
        protected $fillable = [
        'category_id', 'kode_inventaris', 'nama_alat', 'deskripsi', 
        'stok_total', 'stok_tersedia', 'stok_dipinjam', 'stok_rusak', 
        'kondisi', 'lokasi', 'gambar'
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function loanDetails() {
        return $this->hasMany(LoanDetail::class);
    }
}