@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 no-print">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Laporan Peminjaman</h1>
        <p class="text-sm text-gray-500">Cetak rekapitulasi data peminjaman laboratorium.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.reports.excel', request()->all()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i> Export Excel
        </a>
        <a href="{{ route('admin.reports.pdf', request()->all()) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export PDF
        </a>
    </div>
</div>

<!-- Filter Form (Akan hilang saat dicetak) -->
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 no-print">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded-lg p-2 text-sm">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded-lg p-2 text-sm">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="border border-gray-300 rounded-lg p-2 text-sm">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="Returned" {{ request('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
            </select>
        </div>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-900">Filter Data</button>
        <a href="{{ route('admin.reports.index') }}" class="text-sm text-red-500 hover:underline px-2 py-2">Reset</a>
    </form>
</div>

<!-- Area Cetak -->
<div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <!-- Header Cetak -->
    <div class="text-center mb-8 border-b pb-4">
        <h2 class="text-xl font-bold text-gray-800">SMK NEGERI 5 SURAKARTA</h2>
        <p class="text-sm text-gray-600">Laporan Peminjaman Inventaris Laboratorium RPL</p>
        @if(request('start_date') && request('end_date'))
            <p class="text-xs text-gray-500 mt-1">Periode: {{ request('start_date') }} s/d {{ request('end_date') }}</p>
        @endif
    </div>

    <table class="w-full text-left text-sm border-collapse">
        <thead>
            <tr class="border-b-2 border-gray-800">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Kode TRX</th>
                <th class="p-2 border">Nama Peminjam</th>
                <th class="p-2 border">Barang (Jumlah)</th>
                <th class="p-2 border">Tgl Pinjam</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
            <tr>
                <td class="p-2 border text-center">{{ $index + 1 }}</td>
                <td class="p-2 border font-medium">{{ $loan->kode_transaksi }}</td>
                <td class="p-2 border">{{ $loan->user->name }} ({{ $loan->user->kelas }})</td>
                <td class="p-2 border">{{ $loan->details->first()->inventory->nama_alat }} ({{ $loan->details->first()->jumlah }})</td>
                <td class="p-2 border">{{ $loan->tgl_pinjam }}</td>
                <td class="p-2 border">{{ $loan->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 border text-center text-gray-500">Tidak ada data peminjaman pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    @media print {
        /* Sembunyikan sidebar, topbar, dan tombol saat mencetak */
        aside, header, .no-print {
            display: none !important;
        }
        /* Sesuaikan layout utama agar full width saat dicetak */
        body { background: white; }
        main { padding: 0 !important; overflow: visible !important; }
        .bg-white { box-shadow: none !important; border: none !important; padding: 0 !important; }
    }
</style>
@endpush