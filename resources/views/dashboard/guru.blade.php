@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
        <p class="text-sm text-gray-500">Selamat datang, {{ auth()->user()->name }}. Anda dapat meminjam alat laboratorium di sini.</p>
    </div>
    <a href="{{ route('siswa.katalog') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-sm flex items-center">
        <i data-lucide="search" class="w-4 h-4 mr-2"></i> Pinjam Alat Lab
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Total Pengajuan -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Total Pengajuan</p>
            <i data-lucide="file-text" class="w-5 h-5 text-blue-500"></i>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $total_pinjam }} <span class="text-sm font-normal text-gray-400">Kali</span></p>
    </div>
    
    <!-- Pending -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-yellow-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Menunggu Verifikasi</p>
            <i data-lucide="clock" class="w-5 h-5 text-yellow-500"></i>
        </div>
        <p class="text-3xl font-bold text-yellow-600">{{ $pending }} <span class="text-sm font-normal text-gray-400">Pengajuan</span></p>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-orange-500">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs text-gray-500 font-bold uppercase">Sedang Dipinjam</p>
            <i data-lucide="package" class="w-5 h-5 text-orange-500"></i>
        </div>
        <p class="text-3xl font-bold text-orange-600">{{ $active }} <span class="text-sm font-normal text-gray-400">Alat</span></p>
    </div>
</div>

<!-- Riwayat Peminjaman Terakhir -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h2 class="font-bold text-gray-800">Riwayat Peminjaman Terakhir</h2>
        <a href="{{ route('siswa.peminjaman') }}" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <tbody class="divide-y divide-gray-100">
                @forelse($recent_loans as $loan)
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        <p class="font-bold text-gray-800">{{ $loan->details->first()->inventory->nama_alat }}</p>
                        <p class="text-xs text-gray-500">{{ $loan->kode_transaksi }}</p>
                    </td>
                    <td class="p-4">
                        <p class="text-gray-600">{{ $loan->details->first()->jumlah }} Unit</p>
                    </td>
                    <td class="p-4">
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d M Y') }}</p>
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
                <tr><td colspan="4" class="p-8 text-center text-gray-500">Anda belum pernah meminjam alat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection