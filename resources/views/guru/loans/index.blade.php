@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Aktivitas Peminjaman Lab RPL</h1>
    <p class="text-sm text-gray-500">Pantau seluruh transaksi peminjaman inventaris oleh siswa.</p>
</div>

<!-- Form Filter -->
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
    <form action="{{ route('guru.loans.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-end">
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-medium text-gray-700 mb-1">Cari Siswa / Kode TRX</label>
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama atau kode..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="Returned" {{ request('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="bg-gray-800 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-900 h-9.5">Filter Data</button>
        @if(request('search') || request('status'))
            <a href="{{ route('guru.loans.index') }}" class="text-red-500 hover:text-red-700 bg-red-50 dark:bg-red-500/10 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
    Reset Filter
</a>
        @endif
    </form>
</div>

<!-- Tabel Transaksi (Read-Only) -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-50 border-b text-gray-500 uppercase text-xs">
            <tr>
                <th class="p-4 font-medium">Peminjam & Kode TRX</th>
                <th class="p-4 font-medium">Barang (Jumlah)</th>
                <th class="p-4 font-medium">Tanggal Pinjam</th>
                <th class="p-4 font-medium">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($loans as $loan)
            <tr class="hover:bg-gray-50">
                <td class="p-4">
                    <p class="font-bold text-gray-800">{{ $loan->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $loan->user->kelas ?? ucfirst($loan->user->role) }} | {{ $loan->kode_transaksi }}</p>
                </td>
                <td class="p-4">
                    <p class="font-medium text-gray-700">{{ $loan->details->first()->inventory->nama_alat }}</p>
                    <p class="text-xs text-gray-500">{{ $loan->details->first()->jumlah }} Unit</p>
                </td>
                <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d M Y') }}</td>
                <td class="p-4">
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
            <tr>
                <td colspan="4" class="p-8 text-center text-gray-500">Tidak ada aktivitas peminjaman yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">
        {{ $loans->links() }}
    </div>
</div>
@endsection