<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoansExport;

class ReportController extends Controller
{
    // Fungsi Index (Tampilan Tabel Laporan)
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'details.inventory']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pinjam', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->get();
        
        return view('admin.reports.index', compact('loans'));
    }

    // Fungsi Cetak PDF
    public function exportPdf(Request $request)
    {
        $query = Loan::with(['user', 'details.inventory']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pinjam', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->get();

        // Load view khusus cetak PDF, lalu set ukuran kertas A4 (Landscape)
        $pdf = Pdf::loadView('admin.reports.pdf', compact('loans'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_Peminjaman_SIPIN.pdf');
    }

    // Fungsi Export Excel
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LoansExport($request->start_date, $request->end_date), 
            'Laporan_Peminjaman_SIPIN.xlsx'
        );
    }
}