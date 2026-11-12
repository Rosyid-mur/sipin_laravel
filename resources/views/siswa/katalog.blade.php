@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Katalog Inventaris Lab RPL</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">Klik pada barang untuk melihat detail, atau tambahkan langsung ke keranjang.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($inventories as $inv)
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col relative group">
        
        <!-- Area Gambar (Bisa diklik) -->
        <a href="{{ route('siswa.detail', $inv->id) }}" class="h-48 bg-gray-100 dark:bg-gray-700 relative overflow-hidden block">
            @if($inv->gambar)
                <!-- BAGIAN INI YANG DIUBAH MENGGUNAKAN ASSET() -->
                <img src="{{ asset($inv->gambar) }}" alt="{{ $inv->nama_alat }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <!-- Gambar Placeholder jika tidak ada gambar -->
                <img src="https://source.unsplash.com/400x300/?{{ urlencode($inv->nama_alat) }},technology" alt="{{ $inv->nama_alat }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @endif
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-bold shadow-sm {{ $inv->stok_tersedia > 0 ? 'text-green-600' : 'text-red-600' }}">
                Stok: {{ $inv->stok_tersedia }}
            </div>
        </a>

        <!-- Info Barang -->
        <div class="p-5 flex-1 flex flex-col">
            <p class="text-xs font-semibold text-blue-600 mb-1">{{ $inv->category->nama_kategori }}</p>
            <a href="{{ route('siswa.detail', $inv->id) }}" class="hover:text-blue-600 transition-colors">
                <h3 class="font-bold text-gray-800 dark:text-white text-lg mb-1 line-clamp-2">{{ $inv->nama_alat }}</h3>
            </a>
            <p class="text-xs text-gray-500 mb-4 flex items-center">
                <i data-lucide="map-pin" class="w-3 h-3 mr-1"></i> {{ $inv->lokasi }}
            </p>
            
            <div class="mt-auto pt-4 border-t border-gray-50 dark:border-gray-700">
                @if($inv->stok_tersedia > 0)
                    <form action="{{ route('siswa.cart.add', $inv->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="number" name="jumlah" value="1" min="1" max="{{ $inv->stok_tersedia }}" class="w-16 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-center text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                        <button type="submit" class="flex-1 flex items-center justify-center bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 font-semibold py-2 rounded-lg hover:bg-blue-600 hover:text-white transition-colors text-sm">
                            <i data-lucide="shopping-cart" class="w-4 h-4 mr-1"></i> Tambah
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold py-2 rounded-lg cursor-not-allowed">Stok Habis</button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-16 text-center">
        <i data-lucide="package-search" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Belum Ada Barang</h3>
    </div>
    @endforelse
</div>

<!-- Tombol Keranjang Melayang -->
<a href="{{ route('siswa.cart') }}" class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full shadow-lg z-50 flex items-center justify-center transition-transform hover:scale-110">
    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
    @php $cartCount = auth()->user()->carts()->count(); @endphp
    @if($cartCount > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center border-2 border-white">{{ $cartCount }}</span>
    @endif
</a>
@endsection