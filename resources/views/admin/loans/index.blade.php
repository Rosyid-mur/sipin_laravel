@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Peminjaman</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola verifikasi, penyerahan, dan pengembalian alat laboratorium.</p>
</div>

<!-- Form Filter Peminjaman -->
<div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
    <form action="{{ route('admin.loans.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-end">
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Cari Siswa / Kode TRX</label>
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama atau kode..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
            </div>
        </div>
        <div class="w-full md:w-1/4">
            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="Returned" {{ request('status') == 'Returned' ? 'selected' : '' }}>Returned</option>
                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="bg-gray-800 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-900 h-[38px]">Filter Data</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.loans.index') }}" class="text-red-500 hover:text-red-700 bg-red-50 dark:bg-red-500/10 px-4 py-2 rounded-lg text-sm font-medium transition-colors h-[38px] flex items-center">
                Reset Filter
            </a>
        @endif
    </form>
</div>

<!-- Tabel Data Peminjaman -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-x-auto w-full">
    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600 text-gray-500 dark:text-gray-300 uppercase text-xs">
            <tr>
                <th class="p-4 font-medium">Peminjam & Kode TRX</th>
                <th class="p-4 font-medium">Barang (Jumlah)</th>
                <th class="p-4 font-medium">Tanggal Pinjam</th>
                <th class="p-4 font-medium">Status</th>
                <th class="p-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
            @forelse($loans as $loan)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4">
                    <p class="font-bold text-gray-800 dark:text-white">{{ $loan->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $loan->user->kelas ?? ucfirst($loan->user->role) }} | {{ $loan->kode_transaksi }}</p>
                </td>
                <td class="p-4">
                    @foreach($loan->details as $detail)
                        <p class="font-medium text-gray-700 dark:text-gray-200">- {{ $detail->inventory->nama_alat ?? '-' }} ({{ $detail->jumlah }} Unit)</p>
                    @endforeach
                </td>
                <td class="p-4">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d M Y') }}</td>
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
                <td class="p-4 text-right space-x-2">
                    @if($loan->status == 'Pending')
                        <form action="{{ route('admin.loans.verifikasi', $loan->id) }}" method="POST" class="inline-block">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Approved">
                            <button type="button" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600 btn-approve" data-action="{{ route('admin.loans.verifikasi', $loan->id) }}">Setujui</button>
                        </form>
                        
                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 btn-reject" data-action="{{ route('admin.loans.verifikasi', $loan->id) }}">
                            Tolak
                        </button>
                        
                    @elseif($loan->status == 'Approved')
                        <!-- Tombol Serah Terima (Type Submit) -->
                        <form action="{{ route('admin.loans.serah', $loan->id) }}" method="POST" class="inline-block form-serah">
                            @csrf @method('PUT')
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">Serah Terima</button>
                        </form>
                    @elseif($loan->status == 'Borrowed')
                        <a href="{{ route('admin.loans.form-kembali', $loan->id) }}" class="bg-orange-500 text-white px-3 py-1 rounded text-xs hover:bg-orange-600">Proses Kembali</a>
                    @else
                        <span class="text-gray-400 text-xs italic">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-500">Belum ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        {{ $loans->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ================= LOGIKA TOMBOL TOLAK =================
        document.querySelectorAll('.btn-reject').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const actionUrl = this.getAttribute('data-action');
                
                Swal.fire({
                    title: 'Tolak Pengajuan?',
                    text: "Berikan alasan agar siswa/guru tahu kenapa ditolak:",
                    input: 'text',
                    inputPlaceholder: 'Contoh: Stok habis / Jadwal bentrok',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    confirmButtonText: 'Ya, Tolak',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Alasan penolakan tidak boleh kosong!'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.createElement('form');
                        form.method = 'POST';
                        form.action = actionUrl;
                        
                        let csrf = document.createElement('input');
                        csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
                        let method = document.createElement('input');
                        method.type = 'hidden'; method.name = '_method'; method.value = 'PUT';
                        let status = document.createElement('input');
                        status.type = 'hidden'; status.name = 'status'; status.value = 'Rejected';
                        let catatan = document.createElement('input');
                        catatan.type = 'hidden'; catatan.name = 'catatan_admin'; catatan.value = result.value;
                        
                        form.appendChild(csrf); form.appendChild(method); form.appendChild(status); form.appendChild(catatan);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // ================= LOGIKA SERAH TERIMA =================
        document.querySelectorAll('.form-serah').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Tahan form agar tidak langsung terkirim
                Swal.fire({ 
                    title: 'Serahkan barang?', 
                    text: "Stok tersedia akan otomatis berkurang.", 
                    icon: 'info', 
                    showCancelButton: true, 
                    confirmButtonColor: '#2563EB', 
                    confirmButtonText: 'Ya, Serahkan' 
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form setelah klik Ya
                    }
                });
            });
        });
    });

    document.querySelectorAll('.btn-approve').forEach(btn => {
    btn.addEventListener('click', function() {
        let actionUrl = this.getAttribute('data-action');
        Swal.fire({
            title: 'Setujui Peminjaman?',
            html: "Dengan menyetujui, stok barang akan <b>dikurangi otomatis</b> dan siswa/guru dapat segera mengambil barang di Lab.<br><br>Pastikan barang fisik sudah siap!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            confirmButtonText: 'Ya, Setujui'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = actionUrl;
                form.innerHTML = `@csrf @method('PUT') <input type="hidden" name="status" value="Approved">`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endpush