<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPIN RPL</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sipin.png') }}">
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
    <style>body { font-family: 'Inter', sans-serif; } h1, h2 { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 h-screen flex items-center justify-center p-4 transition-colors duration-300 relative">

    <!-- Tombol Dark Mode Melayang -->
    <button id="theme-toggle" class="absolute top-6 right-6 p-3 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-full shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
    </button>

    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl w-full max-w-5xl flex overflow-hidden min-h-[600px] border border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <!-- Kiri: Banner -->
        <div class="hidden md:flex flex-col justify-between w-1/2 bg-[#1E293B] p-12 text-white relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-blue-400 via-transparent to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-10">
    <img src="{{ asset('images/logo-sipin.png') }}" alt="Logo SIPIN" class="h-14 w-auto drop-shadow-md">
    <div>
        <h1 class="font-bold text-2xl tracking-wide text-white">SIPIN RPL</h1>
        <p class="text-sm text-gray-400">SMKN 5 Surakarta</p>
    </div>
</div>
                <span class="bg-blue-500/20 text-blue-300 text-xs font-bold px-3 py-1.5 rounded-full mb-6 inline-block border border-blue-500/30">SISTEM INFORMASI</span>
                <h2 class="text-4xl font-bold leading-tight mb-6">Manajemen Logistik & Komponen Praktikum Terpadu</h2>
                <p class="text-gray-400 text-sm leading-relaxed">Platform inventarisasi hardware, modul IoT, workstation, dan perangkat ukur untuk peserta didik dan guru SMK Negeri 5 Surakarta.</p>
            </div>
        </div>

        <!-- Kanan: Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Masuk ke Sistem</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan akun resmi sekolah untuk mengakses permohonan inventaris.</p>
            </div>

            <!-- Tab Role -->
            <div class="flex bg-gray-100 dark:bg-gray-700 p-1 rounded-xl mb-6">
                <button type="button" onclick="setRole('siswa')" id="tab-siswa" class="flex-1 py-2 text-sm font-semibold rounded-lg bg-white dark:bg-gray-800 shadow-sm text-blue-600 dark:text-blue-400 transition-all">Siswa</button>
                <button type="button" onclick="setRole('guru')" id="tab-guru" class="flex-1 py-2 text-sm font-semibold rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-all">Guru</button>
                <button type="button" onclick="setRole('admin')" id="tab-admin" class="flex-1 py-2 text-sm font-semibold rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-all">Admin</button>
            </div>

            <form action="{{ route('login.proses') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Input Hidden untuk menyimpan role yang dipilih -->
                <input type="hidden" name="role" id="input-role" value="siswa">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5" id="label-username">Nomor Induk Siswa (NIS)</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-5 h-5 absolute left-3.5 top-3 text-gray-400"></i>
                        <input type="text" name="username" id="input-username" value="{{ old('username') }}" placeholder="Masukkan NIS" class="w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-600 bg-gray-50 dark:bg-gray-800 focus:bg-white outline-none" required>
                    </div>
                    @error('username') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-5 h-5 absolute left-3.5 top-3 text-gray-400"></i>
                        <input type="password" name="password" id="input-password" placeholder="Masukkan kata sandi" class="w-full pl-11 pr-11 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-600 bg-gray-50 dark:bg-gray-800 focus:bg-white outline-none" required>
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"><i data-lucide="eye" id="icon-eye" class="w-5 h-5"></i><i data-lucide="eye-off" id="icon-eye-off" class="w-5 h-5 hidden"></i></button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg hover:shadow-blue-600/30 flex justify-center items-center mt-2">Masuk ke SIPIN <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i></button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // Script Toggle Password
        function togglePassword() {
            const p = document.getElementById('input-password'); const e = document.getElementById('icon-eye'); const eo = document.getElementById('icon-eye-off');
            if (p.type === 'password') { p.type = 'text'; e.classList.add('hidden'); eo.classList.remove('hidden'); } else { p.type = 'password'; e.classList.remove('hidden'); eo.classList.add('hidden'); }
        }

        // Script Tab Role & Ubah Label/Placeholder
        function setRole(role) {
            // 1. Ubah nilai input hidden
            document.getElementById('input-role').value = role;

            // 2. Ubah style tab
            ['siswa', 'guru', 'admin'].forEach(t => { 
                document.getElementById('tab-' + t).className = t === role 
                ? "flex-1 py-2 text-sm font-semibold rounded-lg bg-white dark:bg-gray-800 shadow-sm text-blue-600 dark:text-blue-400 transition-all" 
                : "flex-1 py-2 text-sm font-semibold rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-all"; 
            });

            // 3. Ubah label & placeholder
            const label = document.getElementById('label-username'); const input = document.getElementById('input-username');
            if(role === 'siswa') { label.innerText = "Nomor Induk Siswa (NIS)"; input.placeholder = "Masukkan NIS"; }
            else if(role === 'guru') { label.innerText = "Nomor Induk Pegawai (NIP)"; input.placeholder = "Masukkan NIP"; }
            else { label.innerText = "Username Admin"; input.placeholder = "Masukkan Username"; }
        }

        // Script Dark Mode
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        document.getElementById('theme-toggle').addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>