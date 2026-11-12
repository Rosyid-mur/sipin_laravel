<header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4 md:px-6 z-30 transition-colors duration-300">
    
    <div class="flex items-center gap-3">
        <!-- Tombol Hamburger (Hanya muncul di HP) -->
        <button onclick="toggleSidebar()" class="md:hidden text-gray-600 dark:text-gray-300 hover:text-blue-600 focus:outline-none">
            <i data-lucide="menu" class="w-7 h-7"></i>
        </button>

        <!-- Search Bar (Responsive) -->
        <form action="{{ route('search') }}" method="GET" class="hidden sm:flex items-center bg-gray-100 dark:bg-gray-700 rounded-lg px-3 py-1.5 w-48 lg:w-96">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 mr-2"></i>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none text-gray-700 dark:text-gray-200">
        </form>
    </div>
    
    <div class="flex items-center space-x-2 md:space-x-4">
        <!-- Tombol Dark Mode -->
        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        </button>

        <!-- Profile Info -->
        <a href="{{ route('profile.index') }}" class="flex items-center hover:bg-gray-50 dark:hover:bg-gray-700 p-1 md:p-2 rounded-lg transition-colors">
            <div class="text-right hidden md:block mr-3">
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ auth()->user()->role }}</p>
            </div>
            @if(auth()->user()->foto_profil)
                <img src="{{ Storage::url(auth()->user()->foto_profil) }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full object-cover shadow-sm">
            @else
                <div class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
        </a>
    </div>
</header>

<!-- Script Toggle Dark Mode di Topbar -->
<script>
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    const themeToggleBtn = document.getElementById('theme-toggle');
    themeToggleBtn.addEventListener('click', function() {
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