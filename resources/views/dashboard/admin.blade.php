@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">Selamat datang, {{ auth()->user()->name }}. Berikut ringkasan Lab RPL hari ini.</p>
    </div>
    
    <!-- Quick Actions -->
    <div class="flex gap-2">
        <a href="{{ route('inventories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Alat
        </a>
        <a href="{{ route('admin.loans.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium shadow-sm flex items-center">
            <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Verifikasi Pengajuan
        </a>
    </div>
</div>

<!-- Statistik Cards (5 Kolom) -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    <!-- Total Katalog -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Total Aset</p>
            <i data-lucide="package" class="w-5 h-5 text-blue-500"></i>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $total_inventaris }} <span class="text-sm font-normal text-gray-400">Jenis</span></p>
    </div>
    
    <!-- Tersedia -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Tersedia</p>
            <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
        </div>
        <p class="text-3xl font-bold text-green-600">{{ $unit_tersedia }} <span class="text-sm font-normal text-gray-400">Unit</span></p>
    </div>

    <!-- Dipinjam -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-orange-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Dipinjam</p>
            <i data-lucide="arrow-right-left" class="w-5 h-5 text-orange-500"></i>
        </div>
        <p class="text-3xl font-bold text-orange-600">{{ $unit_dipinjam }} <span class="text-sm font-normal text-gray-400">Unit</span></p>
    </div>

    <!-- Rusak -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-red-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Rusak</p>
            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500"></i>
        </div>
        <p class="text-3xl font-bold text-red-600">{{ $unit_rusak }} <span class="text-sm font-normal text-gray-400">Unit</span></p>
    </div>

    <!-- Pending -->
    <div class="bg-yellow-50/30 p-4 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-yellow-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Pending</p>
            <i data-lucide="clock" class="w-5 h-5 text-yellow-500"></i>
        </div>
        <p class="text-3xl font-bold text-yellow-600">{{ $pending }} <span class="text-sm font-normal text-gray-400">Pengajuan</span></p>
    </div>
</div>

<!-- Notifikasi Keterlambatan (Muncul jika ada yang telat) -->
@if($overdue_loans->count() > 0)
<div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl shadow-sm flex items-start">
    <i data-lucide="alert-circle" class="w-6 h-6 text-red-500 mr-3 shrink-0"></i>
    <div>
        <h3 class="text-red-800 font-bold mb-1">Peringatan: {{ $overdue_loans->count() }} Barang Terlambat Dikembalikan!</h3>
        <ul class="text-sm text-red-700 list-disc list-inside">
            @foreach($overdue_loans->take(3) as $od)
                <li>{{ $od->user->name }} ({{ $od->details->first()->inventory->nama_alat }}) - Batas: {{ \Carbon\Carbon::parse($od->tgl_kembali_rencana)->format('d M Y') }}</li>
            @endforeach
            @if($overdue_loans->count() > 3)
                <li class="italic">...dan {{ $overdue_loans->count() - 3 }} lainnya.</li>
            @endif
        </ul>
        <a href="{{ route('admin.loans.index', ['status' => 'Borrowed']) }}" class="text-red-600 font-semibold text-sm hover:underline mt-2 inline-block">Lihat Data Peminjaman &rarr;</a>
    </div>
</div>
@endif

<!-- Wadah tersembunyi untuk data grafik (Agar VS Code tidak error) -->
<div id="chart-data" 
    data-labels="{{ json_encode($chartLabels) }}" 
    data-values="{{ json_encode($chartValues) }}">
</div>

<!-- Baris Grafik & Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Kolom Grafik (Kiri) -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 md:col-span-2">
        <h2 class="font-bold text-gray-800 mb-4">Tren Peminjaman {{ date('Y') }}</h2>
        <div class="h-64 w-full">
            <canvas id="loanChart"></canvas>
        </div>
    </div>
    
    <!-- Kolom Info (Kanan) -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-2">
                <i data-lucide="info" class="w-8 h-8 text-blue-600"></i>
            </div>
            <h3 class="font-bold text-gray-800">Total Peminjaman</h3>
            <p class="text-3xl font-extrabold text-blue-600 mt-1">{{ array_sum($chartValues) }}</p>
            <p class="text-xs text-gray-500">Transaksi Tahun Ini</p>
        </div>
    </div>
</div>

<!-- Script Menggambar Grafik -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data dari atribut HTML
        const chartData = document.getElementById('chart-data');
        const labelsData = JSON.parse(chartData.dataset.labels);
        const valuesData = JSON.parse(chartData.dataset.values);

        const ctx = document.getElementById('loanChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsData,
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: valuesData,
                    backgroundColor: 'rgba(37, 99, 235, 0.7)', // Warna biru Primary
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>

<!-- Transaksi Terbaru -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h2 class="font-bold text-gray-800">Aktivitas Peminjaman Terbaru</h2>
        <a href="{{ route('admin.loans.index') }}" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <tbody class="divide-y divide-gray-100">
                @forelse($recent_loans as $loan)
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        <p class="font-bold text-gray-800">{{ $loan->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $loan->user->kelas ?? ucfirst($loan->user->role) }}</p>
                    </td>
                    <td class="p-4">
                        <p class="font-medium text-gray-700">{{ $loan->details->first()->inventory->nama_alat }}</p>
                        <p class="text-xs text-gray-500">{{ $loan->details->first()->jumlah }} Unit | {{ $loan->kode_transaksi }}</p>
                    </td>
                    <td class="p-4">
                        <p class="text-xs text-gray-500">Tgl Pinjam: {{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d M Y') }}</p>
                    </td>
                    <td class="p-4 text-right">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $loan->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $loan->status == 'Approved' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $loan->status == 'Borrowed' ? 'bg-orange-100 text-orange-700' : '' }}
                            {{ $loan->status == 'Returned' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $loan->status == 'Rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $loan->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-8 text-center text-gray-500">Belum ada aktivitas peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection