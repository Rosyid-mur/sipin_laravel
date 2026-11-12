@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('siswa.katalog') }}" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-2 rounded-lg hover:bg-gray-300 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Inventaris</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col md:flex-row">
        <div class="md:w-1/2 h-80 md:h-auto bg-gray-100 dark:bg-gray-700 relative">
            @if($inventory->gambar)
                <!-- MENGGUNAKAN ASSET() -->
                <img src="{{ asset($inventory->gambar) }}" class="w-full h-full object-cover">
            @else
                <img src="https://source.unsplash.com/600x800/?{{ urlencode($inventory->nama_alat) }},technology" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="p-8 md:w-1/2 flex flex-col justify-center">
            <p class="text-sm font-bold text-blue-600 mb-2">{{ $inventory->category->nama_kategori }}</p>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $inventory->nama_alat }}</h2>
            <p class="text-gray-500 mb-6">Kode: {{ $inventory->kode_inventaris }}</p>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Stok Tersedia</p>
                    <p class="font-bold text-lg text-green-600">{{ $inventory->stok_tersedia }} Unit</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Kondisi</p>
                    <p class="font-bold text-lg">{{ $inventory->kondisi }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Lokasi</p>
                    <p class="font-bold">{{ $inventory->lokasi }}</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <p class="text-xs text-gray-500 mb-1">Maks. Pinjam</p>
                    <p class="font-bold">{{ $inventory->category->max_hari }} Hari</p>
                </div>
            </div>

            <p class="text-gray-600 dark:text-gray-300 text-sm mb-8">{{ $inventory->deskripsi ?? 'Tidak ada deskripsi untuk barang ini.' }}</p>

            @if($inventory->stok_tersedia > 0)
                <form action="{{ route('siswa.cart.add', $inventory->id) }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="number" name="jumlah" value="1" min="1" max="{{ $inventory->stok_tersedia }}" class="w-20 text-center border rounded-lg dark:bg-gray-700 dark:text-white">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">Tambah ke Keranjang</button>
                </form>
            @else
                <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-xl font-bold cursor-not-allowed">Stok Habis</button>
            @endif
        </div>
    </div>
</div>
@endsection