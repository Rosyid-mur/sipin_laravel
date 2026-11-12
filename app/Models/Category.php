<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['kode_kategori', 'nama_kategori', 'deskripsi', 'max_hari', 'max_unit', 'butuh_guru'];
    
    public function inventories() {
        return $this->hasMany(Inventory::class);
    }
}