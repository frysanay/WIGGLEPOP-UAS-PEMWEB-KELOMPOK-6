<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - {{ config('app.name', 'Wigglepop') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#88a2ff',
                            green: '#e3fc87',
                            deep: '#253a82',
                            pink: '#ffb2e7',
                            sky: '#c0e0ff',
                            purple: '#ab9dff',
                        }
                    },
                    fontFamily: {
                        sans: ['Quicksand', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Dark Mode Initial State -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 flex h-full font-sans transition-colors duration-300">

    <!-- Sidebar Navigation -->
    <aside class="hidden md:flex flex-col w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <!-- Logo Header -->
        <div class="h-20 flex items-center gap-2 px-6 border-b border-gray-100 dark:border-gray-800">
            <img src="{{ asset('images/wigglepop-logo.png') }}" alt="Wigglepop Logo" class="h-10 w-auto">
            <span class="font-heading text-lg font-bold bg-gradient-to-r from-brand-blue to-brand-purple bg-clip-text text-transparent">Wigglepop Admin</span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.products.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="package" class="w-4 h-4"></i> Produk
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.categories.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="folder" class="w-4 h-4"></i> Kategori
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.orders.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Pesanan
            </a>
            <a href="{{ route('admin.custom-orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.custom-orders.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="sparkles" class="w-4 h-4"></i> Custom Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.users.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="users" class="w-4 h-4"></i> Pengguna
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.contacts.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="mail" class="w-4 h-4"></i> Pesan Masuk
            </a>
            <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request()->routeIs('admin.profile.*') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i data-lucide="user-cog" class="w-4 h-4"></i> Profil Toko
            </a>
        </nav>

        <!-- Footer / Return to main site -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Toko
            </a>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-950/20 transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Topbar Navbar -->
        <header class="h-20 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6 transition-colors duration-300">
            <!-- Left Header Control -->
            <div class="flex items-center gap-4">
                <!-- Mobile Sidebar Toggle -->
                <button id="mobile-sidebar-toggle" class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 md:hidden transition">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="font-heading text-lg font-bold text-gray-800 dark:text-white">Admin Control Panel</h1>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                </button>

                <!-- Profile avatar -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-brand-pink to-brand-purple text-white flex items-center justify-center font-bold text-sm">
                        A
                    </div>
                    <span class="hidden sm:inline text-sm font-semibold text-gray-700 dark:text-gray-300">Admin</span>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow p-6 overflow-y-auto">
            <!-- Flash Alert Messages -->
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800/30 text-green-700 dark:text-green-300 rounded-2xl shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-800/30 text-red-700 dark:text-red-300 rounded-2xl shadow-sm">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                    <p class="font-medium text-sm">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Drawer Sidebar (Fallback) -->
    <div id="mobile-sidebar" class="fixed inset-0 z-50 flex hidden">
        <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-black/55 backdrop-blur-sm"></div>
        <div class="relative w-64 bg-white dark:bg-gray-900 h-full flex flex-col p-4 shadow-xl border-r border-gray-200 dark:border-gray-800">
            <!-- Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <span class="font-heading text-lg font-bold text-brand-purple">Menu Admin</span>
                <button id="mobile-sidebar-close" class="p-1.5 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <!-- Links -->
            <nav class="flex-grow py-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="package" class="w-4 h-4"></i> Produk
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="folder" class="w-4 h-4"></i> Kategori
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> Pesanan
                </a>
                <a href="{{ route('admin.custom-orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Custom Orders
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="users" class="w-4 h-4"></i> Pengguna
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="mail" class="w-4 h-4"></i> Pesan Masuk
                </a>
                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="user-cog" class="w-4 h-4"></i> Profil Toko
                </a>
            </nav>
        </div>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();

        // Dark/Light Mode toggle script
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Mobile Sidebar toggles
        const mobileToggle = document.getElementById('mobile-sidebar-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileClose = document.getElementById('mobile-sidebar-close');
        const mobileBackdrop = document.getElementById('mobile-sidebar-backdrop');

        const toggleSidebar = () => mobileSidebar.classList.toggle('hidden');

        mobileToggle.addEventListener('click', toggleSidebar);
        mobileClose.addEventListener('click', toggleSidebar);
        mobileBackdrop.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
