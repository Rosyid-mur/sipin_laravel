<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPIN - Sistem Informasi Peminjaman Inventaris</title>
    
    <!-- Favicon -->
    <!-- Hapus link favicon yang lama, ganti dengan ini -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sipin.png') }}?v=1.1">
    
    <!-- Anti FOUC (Kedipan Dark Mode) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-[#F8FAFC] dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">

    <!-- Overlay Gelap (Hanya muncul di HP saat sidebar terbuka) -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Area Konten Utama -->
    <div class="flex-1 flex flex-col h-screen w-full overflow-hidden">
        
        <!-- Topbar -->
        @include('components.topbar')

        <!-- Konten Halaman -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
        
        // Script Toggle Sidebar untuk Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-menu');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Buka Sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // Tutup Sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Notifikasi Global
        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ session('error') }}";
        if (successMessage) Swal.fire({ icon: 'success', title: 'Berhasil!', text: successMessage, showConfirmButton: false, timer: 2000 });
        if (errorMessage) Swal.fire({ icon: 'error', title: 'Gagal!', text: errorMessage });
    </script>
    
    @stack('scripts')
</body>
</html>