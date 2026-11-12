@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Riwayat Peminjaman Saya</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Daftar seluruh transaksi peminjaman yang pernah Anda lakukan.</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-x-auto">
    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600 text-gray-500 dark:text-gray-300 uppercase text-xs">
            <tr>
                <th class="p-4 font-medium">Kode TRX</th>
                <th class="p-4 font-medium">Daftar Alat</th>
                <th class="p-4 font-medium">Tgl Pinjam</th>
                <th class="p-4 font-medium">Rencana Kembali</th>
                <th class="p-4 font-medium">Status</th>
                <th class="p-4 font-medium">Denda</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
            @forelse($loans as $loan)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4 font-bold text-blue-600 dark:text-blue-400">{{ $loan->kode_transaksi }}</td>
                <td class="p-4">
                    @foreach($loan->details as $detail)
                        <p class="font-medium text-gray-800 dark:text-white">- {{ $detail->inventory->nama_alat ?? '-' }} ({{ $detail->jumlah }} unit)</p>
                    @endforeach
                </td>
                <td class="p-4">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d M Y') }}</td>
                <td class="p-4">{{ \Carbon\Carbon::parse($loan->tgl_kembali_rencana)->format('d M Y') }}</td>
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
                <td class="p-4">
                    @if($loan->denda > 0)
                        <span class="font-bold text-red-500">Rp {{ number_format($loan->denda, 0, ',', '.') }}</span>
                        <span class="block text-xs {{ $loan->status_denda == 'Lunas' ? 'text-green-500' : 'text-red-400' }}">({{ $loan->status_denda }})</span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-8 text-center text-gray-500">
                    <i data-lucide="inbox" class="w-12 h-12 text-gray-300 mx-auto mb-2"></i>
                    Anda belum pernah melakukan peminjaman.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection