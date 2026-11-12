<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Inventory;
use App\Models\LoanDetail;
use App\Models\ActivityLog; // Tambahan untuk Log
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanController extends Controller
{
    // ================= SISI SISWA =================

    public function katalog()
    {
        $inventories = Inventory::with('category')->where('stok_tersedia', '>', 0)->get();
        return view('siswa.katalog', compact('inventories'));
    }

    public function formPinjam(Inventory $inventory)
    {
        if ($inventory->stok_tersedia <= 0) {
            return redirect()->route('siswa.katalog')->with('error', 'Maaf, stok barang ini sedang kosong.');
        }
        return view('siswa.pinjam', compact('inventory'));
    }

    public function simpanPinjam(Request $request, Inventory $inventory)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $inventory->stok_tersedia,
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:tgl_pinjam',
            'keperluan' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();
            $kode_transaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            $loan = Loan::create([
                'kode_transaksi' => $kode_transaksi,
                'user_id' => Auth::id(),
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
                'keperluan' => $request->keperluan,
                'status' => 'Pending',
            ]);

            LoanDetail::create([
                'loan_id' => $loan->id,
                'inventory_id' => $inventory->id,
                'jumlah' => $request->jumlah,
            ]);


            DB::commit();
            return redirect()->route('siswa.peminjaman')->with('success', 'Pengajuan peminjaman berhasil dikirim! Menunggu verifikasi Admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function riwayatSiswa()
    {
        $loans = Loan::with(['details.inventory'])->where('user_id', Auth::id())->latest()->get();
        return view('siswa.peminjaman', compact('loans'));
    }

    // ================= SISI ADMIN =================

    public function indexAdmin(Request $request)
    {
        $query = Loan::with(['user', 'details.inventory']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_transaksi', 'like', "%{$search}%")
                ->orWhereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->paginate(10)->appends($request->all());
        return view('admin.loans.index', compact('loans'));
    }

        public function verifikasi(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'catatan_admin' => 'nullable|string'
        ]);

        if ($loan->status !== 'Pending') {
            return back()->with('error', 'Transaksi ini sudah diproses sebelumnya.');
        }

        // Jika ditolak, pastikan alasan diisi (bisa divalidasi di frontend/backend)
        if ($request->status === 'Rejected' && empty($request->catatan_admin)) {
            return back()->with('error', 'Alasan penolakan wajib diisi!');
        }

        $loan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        ActivityLog::record('Verifikasi Peminjaman', 'Memproses pengajuan ' . $loan->kode_transaksi . ' menjadi ' . $request->status);

        return back()->with('success', 'Status pengajuan berhasil diperbarui menjadi ' . $request->status);
    }

    public function serahTerima(Loan $loan)
    {
        if ($loan->status !== 'Approved') {
            return back()->with('error', 'Hanya transaksi yang disetujui yang dapat diserahkan.');
        }

        foreach ($loan->details as $detail) {
            if ($detail->inventory->stok_tersedia < $detail->jumlah) {
                return back()->with('error', 'Gagal! Stok ' . $detail->inventory->nama_alat . ' tidak mencukupi. Sisa: ' . $detail->inventory->stok_tersedia);
            }
        }

        try {
            DB::beginTransaction();
            
            $loan->update(['status' => 'Borrowed']);

            foreach ($loan->details as $detail) {
                $inventory = $detail->inventory;
                $inventory->decrement('stok_tersedia', $detail->jumlah);
                $inventory->increment('stok_dipinjam', $detail->jumlah);
            }

            // Catat Log
            ActivityLog::record('Serah Terima Barang', 'Menyerahkan barang untuk transaksi ' . $loan->kode_transaksi);

            DB::commit();
            return back()->with('success', 'Barang berhasil diserahkan. Status berubah menjadi Dipinjam.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function formPengembalian(Loan $loan)
    {
        if ($loan->status !== 'Borrowed') {
            return back()->with('error', 'Transaksi tidak valid untuk pengembalian.');
        }
        return view('admin.loans.kembali', compact('loan'));
    }

    public function prosesPengembalian(Request $request, Loan $loan)
    {
        if ($loan->status !== 'Borrowed') {
            return back()->with('error', 'Transaksi sudah dikembalikan atau tidak valid.');
        }

        $request->validate([
            'tgl_kembali_aktual' => 'required|date',
            'kondisi_kembali' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'catatan_kondisi' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // ... kode sebelumnya (DB::beginTransaction) ...

            $tgl_rencana = \Carbon\Carbon::parse($loan->tgl_kembali_rencana)->startOfDay();
            $tgl_aktual = \Carbon\Carbon::parse($request->tgl_kembali_aktual)->startOfDay();
            
            $denda = 0;
            // Jika tanggal aktual lebih besar (lebih lambat) dari tanggal rencana
            if ($tgl_aktual->greaterThan($tgl_rencana)) {
                // Hitung selisih hari (tanpa nilai minus)
                $hari_telat = $tgl_rencana->diffInDays($tgl_aktual);
                $denda = $hari_telat * 5000;
            }

            $loan->update([
                'status' => 'Returned',
                'tgl_kembali_aktual' => $request->tgl_kembali_aktual,
                'denda' => $denda,
                'status_denda' => $denda > 0 ? 'Belum Lunas' : 'Lunas',
            ]);

            // ... kode setelahnya ...

            foreach ($loan->details as $detail) {
                $detail->update([
                    'kondisi_kembali' => $request->kondisi_kembali,
                    'catatan_kondisi' => $request->catatan_kondisi,
                ]);

                $inventory = $detail->inventory;
                $inventory->decrement('stok_dipinjam', $detail->jumlah);
                
                if ($request->kondisi_kembali === 'Baik') {
                    $inventory->increment('stok_tersedia', $detail->jumlah);
                } else {
                    $inventory->increment('stok_rusak', $detail->jumlah);
                    $inventory->update(['kondisi' => $request->kondisi_kembali]);
                }
            }

            // Catat Log
            ActivityLog::record('Pengembalian Barang', 'Menerima kembali barang dari transaksi ' . $loan->kode_transaksi);

            DB::commit();
            return redirect()->route('admin.loans.index')->with('success', 'Pengembalian berhasil dicatat. Stok telah diperbarui.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

        // ================= MANAJEMEN DENDA =================
    
    public function daftarDenda()
    {
        // Ambil transaksi yang punya denda
        $fines = Loan::with(['user', 'details.inventory'])
            ->where('denda', '>', 0)
            ->orderByRaw("FIELD(status_denda, 'Belum Lunas', 'Lunas')") // Urutkan yang belum lunas di atas
            ->latest()
            ->paginate(10);

        // Hitung total denda yang belum masuk (untuk ditampilkan di card)
        $total_belum_lunas = Loan::where('status_denda', 'Belum Lunas')->sum('denda');

        return view('admin.fines.index', compact('fines', 'total_belum_lunas'));
    }

    public function bayarDenda(Loan $loan)
    {
        if ($loan->status_denda === 'Lunas') {
            return back()->with('error', 'Denda ini sudah lunas.');
        }

        $loan->update(['status_denda' => 'Lunas']);

        // Catat Log
        ActivityLog::record('Pelunasan Denda', 'Menerima pembayaran denda untuk transaksi ' . $loan->kode_transaksi);

        return back()->with('success', 'Denda berhasil dilunasi!');
    }

    // ================= SISI GURU =================
    public function indexGuru(Request $request)
    {
        $query = Loan::with(['user', 'details.inventory']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_transaksi', 'like', "%{$search}%")
                ->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->paginate(10)->appends($request->all());
        return view('guru.loans.index', compact('loans'));
    }
    
        // ================= FITUR KERANJANG (DATABASE) =================

    public function addToCart(Request $request, Inventory $inventory)
    {
        $request->validate(['jumlah' => 'required|integer|min:1|max:' . $inventory->stok_tersedia]);

        // Cek apakah barang sudah ada di keranjang user ini
        $cartItem = Cart::where('user_id', Auth::id())->where('inventory_id', $inventory->id)->first();
        
        if ($cartItem) {
            $newJumlah = $cartItem->jumlah + $request->jumlah;
            if ($newJumlah > $inventory->stok_tersedia) {
                return back()->with('error', 'Total barang di keranjang melebihi stok yang tersedia!');
            }
            $cartItem->update(['jumlah' => $newJumlah]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'inventory_id' => $inventory->id,
                'jumlah' => $request->jumlah,
            ]);
        }
        
        return redirect()->route('siswa.katalog')->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        // Ambil data keranjang dari database
        $cart = Cart::with('inventory')->where('user_id', Auth::id())->get();
        return view('siswa.cart', compact('cart'));
    }

    public function removeFromCart($id)
    {
        // Hapus dari database berdasarkan ID cart
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('siswa.cart')->with('success', 'Barang dihapus dari keranjang.');
        }
        return redirect()->route('siswa.cart')->with('error', 'Barang tidak ditemukan.');
    }

    public function checkoutCart(Request $request)
    {
        // Ambil data keranjang dari database
        $cart = Cart::with('inventory')->where('user_id', Auth::id())->get();
        
        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:tgl_pinjam',
            'keperluan' => 'required|string|max:255',
        ]);

        // Validasi batas waktu
        $max_hari_diizinkan = 3; 
        foreach($cart as $item) {
            if ($item->inventory->category->max_hari < $max_hari_diizinkan) {
                $max_hari_diizinkan = $item->inventory->category->max_hari;
            }
        }
        
        $tgl_pinjam = \Carbon\Carbon::parse($request->tgl_pinjam);
        $tgl_kembali = \Carbon\Carbon::parse($request->tgl_kembali_rencana);
        
        if ($tgl_pinjam->diffInDays($tgl_kembali) > $max_hari_diizinkan) {
            return back()->with('error', "Gagal! Batas maksimal peminjaman untuk barang di keranjang ini adalah {$max_hari_diizinkan} hari.");
        }

        try {
            DB::beginTransaction();
            
            $kode_transaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            $loan = Loan::create([
                'kode_transaksi' => $kode_transaksi,
                'user_id' => Auth::id(),
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
                'keperluan' => $request->keperluan,
                'status' => 'Pending',
            ]);

            // Pindahkan semua item dari tabel carts ke tabel loan_details
            foreach($cart as $item) {
                if ($item->inventory->stok_tersedia < $item->jumlah) {
                    DB::rollBack();
                    return back()->with('error', 'Gagal! Stok ' . $item->inventory->nama_alat . ' tidak mencukupi.');
                }

                LoanDetail::create([
                    'loan_id' => $loan->id,
                    'inventory_id' => $item->inventory_id,
                    'jumlah' => $item->jumlah,
                ]);
                
                // Hapus dari keranjang setelah masuk detail transaksi
                $item->delete(); 
            }

            DB::commit();
            ActivityLog::record('Siswa/Guru Meminjam', 'Mengajukan peminjaman dengan kode ' . $kode_transaksi);
            return redirect()->route('siswa.peminjaman')->with('success', 'Pengajuan peminjaman berhasil dikirim! Menunggu verifikasi Admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

        public function showDetail(Inventory $inventory)
    {
        return view('siswa.detail', compact('inventory'));
    }
}