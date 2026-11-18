@extends('layouts.app')

@section('content')
<!-- Header Responsive: Menumpuk di HP, Sejajar di Laptop -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 no-print">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Laporan Peminjaman</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Cetak rekapitulasi data peminjaman laboratorium.</p>
    </div>
    <!-- Tombol Ekspor: Full width di HP, sejajar di Laptop -->
    <div class="flex gap-2 w-full md:w-auto">
        <a href="{{ route('admin.reports.excel', request()->all()) }}" class="flex-1 md:flex-none justify-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i> Export Excel
        </a>
        <a href="{{ route('admin.reports.pdf', request()->all()) }}" class="flex-1 md:flex-none justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export PDF
        </a>
    </div>
</div>

<!-- Filter Form: Menumpuk vertikal di HP -->
<div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6 no-print">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 text-sm">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 text-sm">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 text-sm">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="Returned" {{ request('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-900">Filter Data</button>
            <a href="{{ route('admin.reports.index') }}" class="flex-1 text-center text-red-500 hover:text-red-700 bg-red-50 dark:bg-red-500/10 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Reset</a>
        </div>
    </form>
</div>

<!-- Area Cetak: Ditambahkan overflow-x-auto agar tabel bisa digeser di HP -->
<div class="bg-white dark:bg-gray-800 p-4 md:p-8 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 w-full overflow-x-auto">
    <!-- Header Cetak -->
    <div class="text-center mb-8 border-b pb-4 dark:border-gray-600">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">SMK NEGERI 5 SURAKARTA</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Laporan Peminjaman Inventaris Laboratorium RPL</p>
        @if(request('start_date') && request('end_date'))
            <p class="text-xs text-gray-500 mt-1">Periode: {{ request('start_date') }} s/d {{ request('end_date') }}</p>
        @endif
    </div>

    <!-- Tabel Cetak (whitespace-nowrap mencegah teks turun ke bawah, overflow-x-auto membuat bisa digeser) -->
    <table class="w-full text-left text-sm border-collapse whitespace-nowrap">
        <thead>
            <tr class="border-b-2 border-gray-800 dark:border-gray-400 text-gray-800 dark:text-white">
                <th class="p-2 border dark:border-gray-600">No</th>
                <th class="p-2 border dark:border-gray-600">Kode TRX</th>
                <th class="p-2 border dark:border-gray-600">Nama Peminjam</th>
                <th class="p-2 border dark:border-gray-600">Barang (Jumlah)</th>
                <th class="p-2 border dark:border-gray-600">Tgl Pinjam</th>
                <th class="p-2 border dark:border-gray-600">Status</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-300">
            @forelse($loans as $index => $loan)
            <tr>
                <td class="p-2 border dark:border-gray-600 text-center">{{ $index + 1 }}</td>
                <td class="p-2 border dark:border-gray-600 font-medium">{{ $loan->kode_transaksi }}</td>
                <td class="p-2 border dark:border-gray-600">{{ $loan->user->name }} ({{ $loan->user->kelas }})</td>
                <td class="p-2 border dark:border-gray-600">{{ $loan->details->first()->inventory->nama_alat ?? '-' }} ({{ $loan->details->first()->jumlah ?? 0 }})</td>
                <td class="p-2 border dark:border-gray-600">{{ $loan->tgl_pinjam }}</td>
                <td class="p-2 border dark:border-gray-600">{{ $loan->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 border dark:border-gray-600 text-center text-gray-500">Tidak ada data peminjaman pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    @media print {
        aside, header, .no-print {
            display: none !important;
        }
        body { background: white; }
        main { padding: 0 !important; overflow: visible !important; }
        .bg-white { box-shadow: none !important; border: none !important; padding: 0 !important; }
        table { border: 1px solid #000 !important; }
        th, td { border: 1px solid #000 !important; color: #000 !important; }
    }
</style>
@endpush