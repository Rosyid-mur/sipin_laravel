@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Inventaris Baru</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Daftarkan aset laboratorium baru ke dalam sistem.</p>
    </div>
    <a href="{{ route('inventories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 max-w-3xl transition-colors duration-300">
    <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="category_id" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Alat / Barang <span class="text-red-500">*</span></label>
                <input type="text" name="nama_alat" value="{{ old('nama_alat') }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none" required>
                @error('nama_alat') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi / Spesifikasi</label>
                <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none">{{ old('deskripsi') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok Total <span class="text-red-500">*</span></label>
                <input type="number" name="stok_total" min="1" value="{{ old('stok_total', 1) }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kondisi Awal <span class="text-red-500">*</span></label>
                <select name="kondisi" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak Ringan">Rusak Ringan</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Lokasi Penyimpanan <span class="text-red-500">*</span></label>
                <!-- DROPDOWN LOKASI BARU -->
                <select name="lokasi" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none" required>
                    <option value="">-- Pilih Lokasi --</option>
                    <option value="Ruang Lab RPL 4" {{ old('lokasi') == 'Ruang Lab RPL 4' ? 'selected' : '' }}>Ruang Lab RPL 4</option>
                    <option value="Ruang Tefa" {{ old('lokasi') == 'Ruang Tefa' ? 'selected' : '' }}>Ruang Tefa</option>
                    <option value="Ruang Lab ASM 1" {{ old('lokasi') == 'Ruang Lab ASM 1' ? 'selected' : '' }}>Ruang Lab ASM 1</option>
                    <option value="Ruang Lab ASM 2" {{ old('lokasi') == 'Ruang Lab ASM 2' ? 'selected' : '' }}>Ruang Lab ASM 2</option>
                    <option value="Ruang Lab ASM 3" {{ old('lokasi') == 'Ruang Lab ASM 3' ? 'selected' : '' }}>Ruang Lab ASM 3</option>
                </select>
                @error('lokasi') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Barang (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5 focus:ring-2 focus:ring-blue-600 outline-none">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
            </div>
        </div>
        
        <div class="flex justify-end pt-4 border-t border-gray-100 dark:border-gray-700">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition-colors">Simpan Data Inventaris</button>
        </div>
    </form>
</div>
@endsection