@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('siswa.katalog') }}" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" title="Kembali ke Katalog">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Keranjang Peminjaman</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Periksa kembali barang yang akan Anda pinjam.</p>
        </div>
    </div>
</div>

        @if($cart->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Daftar Barang -->
        <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <table class="w-full text-left text-base"> <!-- Ubah text-sm menjadi text-base -->
    <thead class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
        <tr>
            <th class="p-5 font-bold text-gray-700 dark:text-gray-300 text-lg">Nama Barang</th>
            <th class="p-5 font-bold text-gray-700 dark:text-gray-300 text-lg">Jumlah</th>
            <th class="p-5 font-bold text-right text-gray-700 dark:text-gray-300 text-lg">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-lg"> <!-- text-lg -->
        @foreach($cart as $item)
        <tr>
            <td class="p-5"><p class="font-bold text-gray-800 dark:text-white">{{ $item->inventory->nama_alat }}</p></td>
            <td class="p-5 text-gray-700 dark:text-gray-300 font-semibold">{{ $item->jumlah }} Unit</td>
            <td class="p-5 text-right">
                <form action="{{ route('siswa.cart.remove', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
        </div>

        <!-- Form Checkout -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="font-bold text-gray-800 mb-4 border-b pb-2">Detail Pengajuan</h2>
            <form action="{{ route('siswa.cart.checkout') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-medium mb-1">Tanggal Mulai Pinjam</label>
                    <input type="date" name="tgl_pinjam" value="{{ date('Y-m-d') }}" class="w-full border p-2 text-sm rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-medium mb-1">Rencana Kembali</label>
                    <input type="date" name="tgl_kembali_rencana" value="{{ date('Y-m-d', strtotime('+3 days')) }}" class="w-full border p-2 text-sm rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <p class="text-xs text-red-500 mt-1">*Batas maksimal peminjaman menyesuaikan aturan kategori barang.</p>
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-medium mb-1">Keperluan</label>
                    <textarea name="keperluan" rows="3" placeholder="Contoh: Praktikum IoT" class="w-full border p-2 text-sm rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">Kirim Pengajuan Pinjam</button>
            </form>
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl border border-dashed border-gray-300 p-12 text-center">
        <i data-lucide="shopping-cart" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
        <h2 class="text-lg font-bold text-gray-800">Keranjang Masih Kosong</h2>
        <p class="text-gray-500 mb-4">Anda belum menambahkan barang apa pun.</p>
        <a href="{{ route('siswa.katalog') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700">Lihat Katalog</a>
    </div>
    @endif
</div>
@endsection