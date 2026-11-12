@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Master Data Inventaris Lab RPL</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola katalog komponen mikrokontroler, modul sensor, laptop, dan perangkat praktikum.</p>
    </div>
    @if(auth()->user()->role == 'admin')
    <a href="{{ route('inventories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Barang
    </a>
    @endif
</div>

<!-- Statistik Cards (Bisa disesuaikan agar lebih rapi) -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">TOTAL KATALOG</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $total_katalog }} <span class="text-sm font-normal text-gray-400">Jenis</span></p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 border-l-4 border-l-green-500">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">SIAP DIGUNAKAN</p>
        <p class="text-2xl font-bold text-green-600">{{ $siap_digunakan }} <span class="text-sm font-normal text-gray-400">Unit Aktif</span></p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 border-l-4 border-l-yellow-500">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">SEDANG DIPINJAM</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $sedang_dipinjam }} <span class="text-sm font-normal text-gray-400">oleh Siswa</span></p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 border-l-4 border-l-red-500">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">PERLU PERBAIKAN</p>
        <p class="text-2xl font-bold text-red-600">{{ $perlu_perbaikan }} <span class="text-sm font-normal text-gray-400">Unit Rusak</span></p>
    </div>
</div>

<!-- Filter & Search -->
<div class="bg-white dark:bg-gray-800 p-4 rounded-t-xl border-b border-gray-100 dark:border-gray-700">
    <form action="{{ auth()->user()->role == 'admin' ? route('inventories.index') : route('guru.inventories.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
        <div class="relative w-full md:w-1/3">
            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-3 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau kode..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
        </div>
        
        <select name="category" class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-600 outline-none w-full md:w-1/4">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-900">Cari Data</button>
        
        <!-- TOMBOL RESET YANG SUDAH DIPERBAIKI -->
        @if(request('search') || request('category'))
            <a href="{{ auth()->user()->role == 'admin' ? route('inventories.index') : route('guru.inventories.index') }}" class="text-red-500 text-sm px-4 py-2 hover:bg-red-50 dark:hover:bg-gray-700 rounded-lg font-medium">Reset Pencarian</a>
        @endif
    </form>
</div>

<!-- Tabel Inventaris -->
<div class="bg-white dark:bg-gray-800 rounded-b-xl shadow-sm border border-t-0 border-gray-100 dark:border-gray-700 overflow-x-auto">
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 font-medium">Kode Barang</th>
                <th class="px-6 py-4 font-medium">Nama Barang</th>
                <th class="px-6 py-4 font-medium">Kategori</th>
                <th class="px-6 py-4 font-medium">Stok Total</th>
                <th class="px-6 py-4 font-medium">Stok Tersedia</th>
                <th class="px-6 py-4 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
            @forelse($inventories as $inv)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">{{ $inv->kode_inventaris }}</td>
                <td class="px-6 py-4">
                    <p class="font-bold text-gray-800 dark:text-white">{{ $inv->nama_alat }}</p>
                </td>
                <td class="px-6 py-4">{{ $inv->category->nama_kategori }}</td>
                <td class="px-6 py-4">{{ $inv->stok_total }} Unit</td>
                <td class="px-6 py-4 font-medium {{ $inv->stok_tersedia <= 2 ? 'text-red-500' : 'text-green-600' }}">
                    {{ $inv->stok_tersedia }} Tersedia
                </td>
                <td class="px-6 py-4 space-x-2">
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('inventories.qr', $inv->id) }}" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:text-blue-700 font-medium" title="Cetak QR">
    <i data-lucide="qr-code" class="w-4 h-4 inline"></i> QR
</a>
                        <a href="{{ route('inventories.edit', $inv->id) }}" class="text-yellow-500 hover:text-yellow-600">Edit</a>
                        <!-- Form Hapus dengan class form-delete -->
                        <form action="{{ route('inventories.destroy', $inv->id) }}" method="POST" class="inline-block form-delete">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs italic">Read-Only</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i data-lucide="package-search" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                    <p class="text-lg font-medium">Data Tidak Ditemukan</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        {{ $inventories->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({ 
                    title: 'Yakin hapus barang ini?', 
                    text: "Data inventaris akan hilang secara permanen.",
                    icon: 'warning', 
                    showCancelButton: true, 
                    confirmButtonColor: '#EF4444', 
                    confirmButtonText: 'Ya, Hapus!' 
                }).then((result) => { 
                    if (result.isConfirmed) form.submit(); 
                });
            });
        });
    });
</script>
@endpush