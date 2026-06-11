<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Wigglepop') . ' - Cute Handmade Accessories')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Wigglepop - Aksesori handmade lucu seperti bagcharm, bracelet, keychain, dan phonestrap untuk melengkapi gayamu.')">
    @yield('meta_extra')
    
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
                            pastelPink: '#FFF5F8',
                            pastelPurple: '#F7F5FF',
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
    
    <!-- Custom Style for transitions -->
    <style>
        .custom-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
    
    <!-- Dark Mode Initial State -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-brand-pastelPink dark:bg-gray-950 text-gray-800 dark:text-gray-100 flex flex-col min-h-full font-sans custom-transition">

    <!-- Header Navbar -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-brand-pink/20 dark:border-gray-800 shadow-sm custom-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('images/wigglepop-logo.png') }}" alt="Wigglepop Logo" class="h-12 w-auto group-hover:scale-105 transition-transform duration-300">
                    <span class="font-heading text-2xl font-bold bg-gradient-to-r from-brand-blue to-brand-purple bg-clip-text text-transparent">Wigglepop</span>
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="font-semibold text-gray-600 dark:text-gray-300 hover:text-brand-purple dark:hover:text-brand-pink {{ request()->routeIs('home') ? 'text-brand-purple dark:text-brand-pink' : '' }} custom-transition">Beranda</a>
                    <a href="{{ route('catalog') }}" class="font-semibold text-gray-600 dark:text-gray-300 hover:text-brand-purple dark:hover:text-brand-pink {{ request()->routeIs('catalog*') ? 'text-brand-purple dark:text-brand-pink' : '' }} custom-transition">Katalog</a>
                    <a href="{{ route('custom-order.index') }}" class="font-semibold text-gray-600 dark:text-gray-300 hover:text-brand-purple dark:hover:text-brand-pink {{ request()->routeIs('custom-order*') ? 'text-brand-purple dark:text-brand-pink' : '' }} custom-transition">Custom Order</a>
                    <a href="{{ route('contact.index') }}" class="font-semibold text-gray-600 dark:text-gray-300 hover:text-brand-purple dark:hover:text-brand-pink {{ request()->routeIs('contact*') ? 'text-brand-purple dark:text-brand-pink' : '' }} custom-transition">Hubungi Kami</a>
                </nav>

                <!-- Actions / Controls -->
                <div class="flex items-center gap-4">
                    <!-- Light/Dark Toggle -->
                    <button id="theme-toggle" class="p-2.5 rounded-full text-gray-600 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition-colors duration-200">
                        <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                        <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                    </button>

                    @auth
                        <!-- Shopping Cart / Checkout -->
                        <a href="{{ route('checkout.index') }}" class="relative p-2.5 rounded-full text-gray-600 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition-colors duration-200" title="Keranjang Belanja">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            @if(session()->has('cart') && count(session()->get('cart')) > 0)
                                <span class="absolute top-1 right-1 bg-brand-purple dark:bg-brand-pink text-white dark:text-gray-950 text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
                                    {{ array_sum(array_column(session()->get('cart'), 'quantity')) }}
                                </span>
                            @endif
                        </a>

                        <!-- Wishlist -->
                        <a href="{{ route('wishlist.index') }}" class="relative p-2.5 rounded-full text-gray-600 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition-colors duration-200" title="Wishlist">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </a>

                        <!-- Orders -->
                        <a href="{{ route('orders.index') }}" class="p-2.5 rounded-full text-gray-600 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition-colors duration-200" title="Pesanan Saya">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </a>
                        
                        <!-- Profile Dropdown / User Profile -->
                        <div class="relative group">
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 p-1 rounded-full hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition-all duration-200">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-brand-pink to-brand-purple text-white flex items-center justify-center font-bold text-sm">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="hidden sm:inline font-medium text-sm text-gray-700 dark:text-gray-300 max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                            </a>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-2xl shadow-lg py-2 border border-brand-pink/20 dark:border-gray-700 scale-95 opacity-0 pointer-events-none group-hover:scale-100 group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 origin-top-right">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-700">
                                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-brand-purple"></i> Dashboard Admin
                                    </a>
                                @endif
                                <a href="{{ route('profile.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-700">
                                    <i data-lucide="user" class="w-4 h-4 text-brand-blue"></i> Profil Saya
                                </a>
                                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30">
                                        <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login / Register Buttons -->
                        <div class="hidden sm:flex items-center gap-3">
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full font-semibold text-brand-purple dark:text-brand-pink hover:bg-brand-pink/10 transition duration-200">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2 rounded-full font-semibold bg-gradient-to-r from-brand-pink to-brand-purple text-white shadow-md shadow-brand-purple/20 hover:shadow-lg hover:shadow-brand-purple/30 transition duration-200">Daftar</a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-toggle" class="p-2 rounded-lg md:hidden text-gray-600 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 transition duration-200">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-brand-pink/10 dark:border-gray-800 bg-white dark:bg-gray-900 custom-transition">
            <div class="px-2 pt-2 pb-4 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Beranda</a>
                <a href="{{ route('catalog') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Katalog</a>
                <a href="{{ route('custom-order.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Custom Order</a>
                <a href="{{ route('contact.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Hubungi Kami</a>
                @auth
                    <div class="border-t border-brand-pink/10 dark:border-gray-800 my-2 pt-2"></div>
                    <a href="{{ route('checkout.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800 flex justify-between items-center">
                        <span>Keranjang Belanja</span>
                        @if(session()->has('cart') && count(session()->get('cart')) > 0)
                            <span class="bg-brand-purple dark:bg-brand-pink text-white dark:text-gray-950 text-xs font-bold rounded-full px-2 py-0.5">
                                {{ array_sum(array_column(session()->get('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Wishlist</a>
                    <a href="{{ route('orders.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-brand-pink/10 dark:hover:bg-gray-800">Pesanan Saya</a>
                @endauth
                @guest
                    <div class="border-t border-brand-pink/10 dark:border-gray-800 my-2 pt-2 flex flex-col gap-2 px-3">
                        <a href="{{ route('login') }}" class="w-full text-center py-2.5 rounded-xl font-semibold border border-brand-purple text-brand-purple dark:border-brand-pink dark:text-brand-pink">Masuk</a>
                        <a href="{{ route('register') }}" class="w-full text-center py-2.5 rounded-xl font-semibold bg-gradient-to-r from-brand-pink to-brand-purple text-white">Daftar</a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <!-- Flash Alert Messages -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            @if(session('success'))
                <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800/30 text-green-700 dark:text-green-300 rounded-2xl shadow-sm">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-800/30 text-red-700 dark:text-red-300 rounded-2xl shadow-sm">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                    <p class="font-medium text-sm">{{ session('error') }}</p>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 border-t border-brand-pink/20 dark:border-gray-800 py-12 custom-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Info -->
                <div class="space-y-4 col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/wigglepop-logo.png') }}" alt="Wigglepop Logo" class="h-10 w-auto">
                        <span class="font-heading text-xl font-bold bg-gradient-to-r from-brand-blue to-brand-purple bg-clip-text text-transparent">Wigglepop</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">
                        Menyediakan aneka aksesori handmade lucu dan cantik seperti bagcharm, bracelet, keychain, phonestrap, hingga custom order yang sesuai dengan kepribadian unikmu.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-heading font-semibold text-gray-800 dark:text-white mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-purple transition-colors">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}" class="hover:text-brand-purple transition-colors">Katalog</a></li>
                        <li><a href="{{ route('custom-order.index') }}" class="hover:text-brand-purple transition-colors">Custom Order</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-brand-purple transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="font-heading font-semibold text-gray-800 dark:text-white mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4 text-brand-blue"></i> hello@wigglepop.id</li>
                        <li class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4 text-brand-purple"></i> +62 812 3456 7890</li>
                        <li class="flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-brand-pink"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-brand-pink/15 dark:border-gray-700 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-400 dark:text-gray-500">
                    &copy; {{ date('Y') }} Wigglepop. All rights reserved. Made with Love.
                </p>
                <div class="flex items-center gap-4 text-gray-400 dark:text-gray-500">
                    <a href="#" class="hover:text-brand-purple transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                    <a href="#" class="hover:text-brand-purple transition-colors"><i data-lucide="twitter" class="w-4 h-4"></i></a>
                    <a href="#" class="hover:text-brand-purple transition-colors"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>
    </footer>

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

        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
