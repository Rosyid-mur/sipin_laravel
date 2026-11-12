<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPIN - Sistem Informasi Peminjaman Inventaris</title>
    <!-- Hapus link favicon yang lama, ganti dengan ini -->
<link rel="icon" type="image/png" href="{{ asset('images/logo-sipin.png') }}?v=1.1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>body { font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full z-50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-sipin.png') }}" alt="Logo SIPIN" class="h-12 drop-shadow-sm">
                    <span class="font-bold text-2xl text-blue-600 tracking-tight">SIPIN</span>
                </div>
                <div class="hidden md:flex space-x-8 font-semibold text-gray-600">
                    <a href="#beranda" class="hover:text-blue-600 transition">Beranda</a>
                    <a href="#tentang" class="hover:text-blue-600 transition">Tentang</a>
                    <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
                </div>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5">Masuk Sistem</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-36 pb-20 px-4 bg-gradient-to-br from-blue-50 to-white relative overflow-hidden">
        <!-- Ornamen Background -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-100 blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center relative z-10">
            <div class="md:w-1/2 mb-12 md:mb-0">
                <span class="inline-block bg-blue-100 text-blue-700 font-bold px-4 py-1.5 rounded-full text-sm mb-6">SISTEM INFORMASI LAB RPL</span>
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 text-gray-900">Digitalisasi Peminjaman, <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Inventaris Lebih Terorganisasi!</span></h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">SIPIN hadir untuk mempermudah siswa, guru, dan petugas dalam mengelola peminjaman alat di Laboratorium RPL SMK Negeri 5 Surakarta secara real-time, akurat, dan paperless.</p>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-lg hover:bg-blue-700 shadow-xl shadow-blue-600/30 transition-all hover:-translate-y-1">Mulai Pinjam Alat</a>
                    <a href="#fitur" class="bg-white text-blue-600 border-2 border-blue-100 px-8 py-3.5 rounded-xl font-bold text-lg hover:bg-gray-50 transition-all">Lihat Fitur</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center relative">
                <div class="relative w-full max-w-lg">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl transform rotate-3 scale-105 opacity-20 blur-lg"></div>
                    <!-- Ganti gambar ini dengan screenshot dashboard SIPIN Anda -->
                    <img src="{{ asset('images/dashboard-preview.png') }}" alt="Dashboard SIPIN" class="relative rounded-2xl shadow-2xl border-4 border-white w-full object-cover h-[350px]">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Apa itu SIPIN?</h2>
            <p class="text-lg text-gray-600 leading-relaxed mb-8">SIPIN (Sistem Informasi Peminjaman Inventaris) adalah platform digital yang dirancang khusus untuk menggantikan proses pencatatan manual di Laboratorium RPL. Dengan SIPIN, stok barang terpantau secara real-time, pengajuan pinjaman bisa dilakukan di mana saja, dan laporan dapat dicetak otomatis.</p>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan SIPIN</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Dirancang untuk kemudahan akses, keamanan data, dan pengelolaan inventaris sekolah yang lebih modern.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6"><i data-lucide="package" class="w-7 h-7"></i></div>
                    <h3 class="text-xl font-bold mb-3">Katalog Real-Time</h3>
                    <p class="text-gray-500 leading-relaxed">Cek ketersediaan stok, detail barang, dan lokasi penyimpanan secara akurat sebelum meminjam.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-cyan-100 text-cyan-600 rounded-xl flex items-center justify-center mb-6"><i data-lucide="shopping-cart" class="w-7 h-7"></i></div>
                    <h3 class="text-xl font-bold mb-3">Keranjang Peminjaman</h3>
                    <p class="text-gray-500 leading-relaxed">Pinjam beberapa alat sekaligus dalam satu pengajuan dengan sistem keranjang yang tersimpan aman.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6"><i data-lucide="bar-chart-2" class="w-7 h-7"></i></div>
                    <h3 class="text-xl font-bold mb-3">Laporan Otomatis</h3>
                    <p class="text-gray-500 leading-relaxed">Cetak bukti pinjam dan rekap laporan aktivitas ke format PDF/Excel dengan satu klik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 text-center">
        <img src="{{ asset('images/logo-sipin.png') }}" alt="Logo SIPIN" class="h-16 mx-auto mb-4">
        <p class="text-xl font-bold mb-2">SIPIN RPL</p>
        <p class="text-gray-400 mb-6">Laboratorium Rekayasa Perangkat Lunak SMK Negeri 5 Surakarta</p>
        <div class="border-t border-gray-800 pt-6 text-sm text-gray-500">
            &copy; {{ date('Y') }} Muhammad Rosyid Muryanto. All rights reserved.
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>