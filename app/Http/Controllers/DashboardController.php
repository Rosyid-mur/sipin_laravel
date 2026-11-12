<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        public function index()
    {
        $role = Auth::user()->role;

        // ================= DASHBOARD ADMIN =================
        if ($role == 'admin') {
            $total_inventaris = Inventory::count();
            $unit_tersedia = Inventory::sum('stok_tersedia');
            $unit_dipinjam = Inventory::sum('stok_dipinjam');
            $unit_rusak = Inventory::sum('stok_rusak');
            $pending = Loan::where('status', 'Pending')->count();
            
            $recent_loans = Loan::with(['user', 'details.inventory'])->latest()->take(5)->get();

            // 1. Data untuk Notifikasi Keterlambatan (Hari ini atau sudah lewat)
            $overdue_loans = Loan::with(['user', 'details.inventory'])
                ->where('status', 'Borrowed')
                ->whereDate('tgl_kembali_rencana', '<=', \Carbon\Carbon::today())
                ->get();

            // 2. Data untuk Grafik Chart.js (Peminjaman 12 Bulan Terakhir di Tahun Ini)
            $chartData = Loan::selectRaw('MONTH(created_at) as month, count(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $chartLabels = [];
            $chartValues = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartLabels[] = date('M', mktime(0, 0, 0, $i, 1));
                $chartValues[] = $chartData[$i] ?? 0; // Jika tidak ada data di bulan itu, isi 0
            }

            return view('dashboard.admin', compact(
                'total_inventaris', 'unit_tersedia', 'unit_dipinjam', 'unit_rusak', 'pending', 
                'recent_loans', 'overdue_loans', 'chartLabels', 'chartValues'
            ));
        }  
        
                // ================= DASHBOARD GURU & SISWA =================
        else {
            $total_pinjam = Loan::where('user_id', Auth::id())->count();
            $pending = Loan::where('user_id', Auth::id())->where('status', 'Pending')->count();
            $active = Loan::where('user_id', Auth::id())->where('status', 'Borrowed')->count();
            
            $recent_loans = Loan::with(['details.inventory'])->where('user_id', Auth::id())->latest()->take(5)->get();

            // Jika Guru, tampilkan view dashboard.guru yang sudah diperbarui
            if ($role == 'guru') {
                return view('dashboard.guru', compact('total_pinjam', 'pending', 'active', 'recent_loans'));
            }
            
            // Jika Siswa
            return view('dashboard.siswa', compact('total_pinjam', 'pending', 'active', 'recent_loans'));
        }
    }
        public function logs()
    {
        $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.logs', compact('logs'));
    }
}