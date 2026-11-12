<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection; // Tambahkan ini

class LoansExport implements FromCollection, WithHeadings, WithMapping
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date = null, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    // TAMBAHKAN : Collection DI SINI
    public function collection(): Collection
    {
        $query = Loan::with(['user', 'details.inventory']);
        
        if ($this->start_date && $this->end_date) {
            $query->whereBetween('tgl_pinjam', [$this->start_date, $this->end_date]);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode TRX', 'Nama Peminjam', 'Role', 'Barang', 'Jumlah', 
            'Tgl Pinjam', 'Tgl Kembali Rencana', 'Status', 'Denda'
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->kode_transaksi,
            $loan->user->name ?? '-',
            ucfirst($loan->user->role ?? '-'),
            $loan->details->first()->inventory->nama_alat ?? '-',
            $loan->details->first()->jumlah ?? 0,
            $loan->tgl_pinjam,
            $loan->tgl_kembali_rencana,
            $loan->status,
            'Rp ' . number_format($loan->denda, 0, ',', '.'),
        ];
    }
}