<aside id="sidebar-menu" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col h-screen shadow-sm">
    
    <!-- Logo & Tombol Close (Hanya di HP) -->
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-100 dark:border-gray-700">
    <div class="flex items-center">
        <img src="{{ asset('images/logo-sipin.png') }}" alt="Logo SIPIN" class="h-9 w-auto mr-3">
        <div>
            <h1 class="font-bold text-lg text-gray-800 dark:text-white leading-tight">SIPIN RPL</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400">SMKN 5 Surakarta</p>
        </div>
    </div>
    <button onclick="toggleSidebar()" class="md:hidden text-gray-500 hover:text-red-500">
        <i data-lucide="x" class="w-6 h-6"></i>
    </button>
</div>

    <!-- MENU NAVIGASI (Bisa di-scroll jika terlalu panjang) -->
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
        <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
        </a>

        @if(auth()->user()->role == 'admin')
            <a href="{{ route('inventories.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('inventories.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i> Master Inventaris
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('categories.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="layers" class="w-5 h-5 mr-3"></i> Kategori Barang
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('users.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="users" class="w-5 h-5 mr-3"></i> Manajemen Pengguna
            </a>
            <a href="{{ route('admin.loans.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.loans.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="arrow-right-left" class="w-5 h-5 mr-3"></i> Peminjaman
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="bar-chart-2" class="w-5 h-5 mr-3"></i> Laporan
            </a>
            <a href="{{ route('admin.fines.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.fines.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="receipt" class="w-5 h-5 mr-3"></i> Manajemen Denda
            </a>
            <a href="{{ route('admin.logs') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.logs') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="history" class="w-5 h-5 mr-3"></i> Log Aktivitas
            </a>

        @elseif(auth()->user()->role == 'guru')
            <a href="{{ route('siswa.katalog') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('siswa.katalog') || request()->routeIs('siswa.pinjam') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="book-open" class="w-5 h-5 mr-3"></i> Katalog Inventaris
            </a>
            <a href="{{ route('siswa.peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('siswa.peminjaman') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="file-text" class="w-5 h-5 mr-3"></i> Peminjaman Saya
            </a>
            <a href="{{ route('guru.inventories.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('guru.inventories.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i> Monitoring Inventaris
            </a>
            <a href="{{ route('guru.loans.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('guru.loans.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="clipboard-list" class="w-5 h-5 mr-3"></i> Aktivitas Peminjaman
            </a>

        @else
            <a href="{{ route('siswa.katalog') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('siswa.katalog') || request()->routeIs('siswa.pinjam') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="book-open" class="w-5 h-5 mr-3"></i> Katalog Inventaris
            </a>
            <a href="{{ route('siswa.peminjaman') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('siswa.peminjaman') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="file-text" class="w-5 h-5 mr-3"></i> Peminjaman Saya
            </a>
        @endif

        <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('profile.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('profile.*') ? 'bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <i data-lucide="user" class="w-5 h-5 mr-3"></i> Profil Saya
            </a>
        </div>
    </nav>

    <!-- AREA LOGOUT (Terkunci di bawah) -->
    <div class="p-4 shrink-0 border-t border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
        <form action="{{ route('logout') }}" method="POST" class="form-logout">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full px-3 py-2.5 text-sm font-bold text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-500/10 dark:hover:bg-red-500/20 rounded-lg transition-colors">
                <i data-lucide="log-out" class="w-5 h-5 mr-2"></i> Keluar Sesi
            </button>
        </form>
    </div>
</aside>

<script>
    // Tambahkan konfirmasi logout
    document.querySelector('.form-logout').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Keluar dari SIPIN?',
            text: "Anda harus login kembali untuk mengakses sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>