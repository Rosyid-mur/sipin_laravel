@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header dengan Tombol Kembali -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.loans.index') }}" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Proses Pengembalian</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Periksa kondisi barang sebelum menyelesaikan transaksi.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        
        <!-- Info Transaksi & Daftar Barang -->
        <div class="mb-6 p-5 bg-orange-50 dark:bg-orange-500/10 rounded-xl border border-orange-100 dark:border-orange-500/20">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="font-bold text-orange-800 dark:text-orange-400 text-lg">{{ $loan->kode_transaksi }}</h3>
                    <p class="text-sm text-orange-600 dark:text-orange-300">Peminjam: <span class="font-bold">{{ $loan->user->name }}</span> ({{ $loan->user->kelas ?? ucfirst($loan->user->role) }})</p>
                </div>
                <span class="bg-orange-200 dark:bg-orange-800 text-orange-800 dark:text-orange-200 text-xs font-bold px-3 py-1 rounded-full">Sedang Dipinjam</span>
            </div>
            
            <div class="border-t border-orange-200 dark:border-orange-500/30 pt-3 mt-3">
                <p class="text-sm font-semibold text-orange-800 dark:text-orange-400 mb-2">Barang yang harus dikembalikan:</p>
                <ul class="space-y-1">
                    @foreach($loan->details as $detail)
                        <li class="text-sm text-gray-700 dark:text-gray-300 flex justify-between">
                            <span>- {{ $detail->inventory->nama_alat }}</span>
                            <span class="font-bold">{{ $detail->jumlah }} Unit</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <form action="{{ route('admin.loans.proses-kembali', $loan->id) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Dikembalikan</label>
                <input type="date" name="tgl_kembali_aktual" value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-2.5 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" required>
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kondisi Barang Saat Kembali</label>
                <select name="kondisi_kembali" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-2.5 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <option value="Baik">Baik (Masuk Stok Tersedia)</option>
                    <option value="Rusak Ringan">Rusak Ringan (Masuk Stok Rusak)</option>
                    <option value="Rusak Berat">Rusak Berat (Masuk Stok Rusak)</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Kondisi (Opsional)</label>
                <textarea name="catatan_kondisi" rows="3" placeholder="Contoh: Ada goresan sedikit pada casing..." class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-2.5 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
            </div>
            
            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-xl font-bold hover:bg-orange-600 transition-colors shadow-sm">
                Selesaikan Transaksi & Kembalikan Stok
            </button>
        </form>
    </div>
</div>
@endsection