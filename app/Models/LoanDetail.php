<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model {
    protected $fillable = ['loan_id', 'inventory_id', 'jumlah', 'kondisi_kembali', 'catatan_kondisi'];

    public function loan() {
        return $this->belongsTo(Loan::class);
    }
    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}