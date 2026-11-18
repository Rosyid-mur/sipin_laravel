@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Denda</h1>
    <p class="text-sm text-gray-500">Kelola denda keterlambatan pengembalian inventaris.</p>
</div>

<!-- Card Total Denda -->
<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-red-500 mb-6 max-w-md">
    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Total Denda Belum Dibayar</p>
    <p class="text-3xl font-extrabold text-red-600">Rp {{ number_format($total_belum_lunas, 0, ',', '.') }}</p>
</div>

<!-- Tabel Denda -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-50 border-b text-gray-500 uppercase text-xs">
            <tr>
                <th class="p-4 font-medium">Nama Peminjam</th>
                <th class="p-4 font-medium">Kode TRX & Barang</th>
                <th class="p-4 font-medium">Tgl Kembali (Rencana/Aktual)</th>
                <th class="p-4 font-medium">Jumlah Denda</th>
                <th class="p-4 font-medium">Status</th>
                <th class="p-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($fines as $fine)
            <tr class="hover:bg-gray-50">
                <td class="p-4">
                    <p class="font-bold text-gray-800">{{ $fine->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $fine->user->kelas ?? ucfirst($fine->user->role) }}</p>
                </td>
                <td class="p-4">
                    <p class="font-medium text-gray-700">{{ $fine->details->first()->inventory->nama_alat ?? '-' }}</p>
                    <p class="text-xs text-blue-600 font-semibold">{{ $fine->kode_transaksi }}</p>
                </td>
                <td class="p-4">
                    <p class="text-xs text-gray-500">Rencana: {{ \Carbon\Carbon::parse($fine->tgl_kembali_rencana)->format('d M Y') }}</p>
                    <p class="text-xs text-red-500 font-semibold">Aktual: {{ \Carbon\Carbon::parse($fine->tgl_kembali_aktual)->format('d M Y') }}</p>
                </td>
                <td class="p-4 font-bold text-red-600">
                    Rp {{ number_format($fine->denda, 0, ',', '.') }}
                </td>
                <td class="p-4">
                    @if($fine->status_denda == 'Lunas')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Lunas</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Belum Lunas</span>
                    @endif
                </td>
                <td class="p-4 text-right">
                    @if($fine->status_denda == 'Belum Lunas')
                        <form action="{{ route('admin.fines.bayar', $fine->id) }}" method="POST" class="form-bayar">
    @csrf @method('PUT')
    <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded text-xs btn-bayar">Tandai Lunas</button>
</form>
                    @else
                        <span class="text-gray-400 text-xs italic">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-8 text-center text-gray-500">Belum ada data denda.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">
        {{ $fines->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-bayar').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Konfirmasi Pelunasan',
                    text: "Apakah denda ini sudah dibayar lunas?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10B981',
                    confirmButtonText: 'Ya, Lunas'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush