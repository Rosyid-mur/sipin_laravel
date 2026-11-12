@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Profil Saya</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Informasi detail akun dan pengaturan keamanan Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Kartu Identitas (Read-Only) -->
        <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden h-fit">
            <div class="h-32 bg-blue-600 dark:bg-blue-800"></div>
            <div class="px-6 pb-6 relative">
                <div class="flex justify-center -mt-16 mb-4">
                    @if($user->foto_profil)
                        <img src="{{ Storage::url($user->foto_profil) }}" class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 object-cover bg-white shadow-md">
                    @else
                        <div class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 bg-blue-100 text-blue-600 flex items-center justify-center text-5xl font-bold shadow-md">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $user->role }} | {{ $user->status_akun }}</p>
                </div>

                <div class="space-y-3 text-sm">
                    @if($user->role == 'siswa')
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">NIS</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->username }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">Kelas</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->kelas }}</span>
                        </div>
                    @elseif($user->role == 'guru')
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">NIP</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->username }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">Mapel</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->mata_pelajaran }}</span>
                        </div>
                    @else
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">ID Admin</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ $user->username }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-2">
                            <span class="text-gray-500">Unit Kerja</span>
                            <span class="font-medium text-gray-800 dark:text-white text-right">{{ $user->unit_kerja }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Edit (No HP & Password) -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-100 dark:border-gray-700 pb-3">Pengaturan Akun</h3>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Input Nomor HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nomor Handphone (WhatsApp)</label>
                        <div class="relative">
                            <i data-lucide="phone" class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"></i>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Contoh: 081234567890" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                        @error('no_hp') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <hr class="border-gray-100 dark:border-gray-700">

                    <!-- Input Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Baru (Opsional)</label>
                        <div class="relative">
                            <i data-lucide="lock" class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"></i>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                        @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <i data-lucide="shield-check" class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"></i>
                            <input type="password" name="password_confirmation" placeholder="Ketik ulang password baru" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 dark:bg-gray-700/50 p-4 rounded-xl flex items-start">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3 shrink-0"></i>
                        <p class="text-sm text-blue-800 dark:text-blue-300">Nama, NIS/NIP, Kelas, dan Foto Profil hanya dapat diubah oleh Admin/Petugas Laboratorium.</p>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition-colors flex items-center">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection