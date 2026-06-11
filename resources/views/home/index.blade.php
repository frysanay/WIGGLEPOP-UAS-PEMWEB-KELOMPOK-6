@extends('layouts.app')

@section('title', 'Wigglepop - Aksesori Handmade Lucu & Cantik')
@section('meta_description', 'Wigglepop - Cute handmade bagcharms, bracelets, keychains, dan phonestraps yang dibuat dengan cinta untuk melengkapi gayamu sehari-hari.')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-tr from-brand-pastelPink via-white to-brand-pastelPurple dark:from-gray-900 dark:via-gray-950 dark:to-gray-900 py-16 sm:py-24 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Text -->
            <div class="space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-semibold bg-brand-pink/15 text-brand-purple dark:text-brand-pink border border-brand-pink/20">
                    💖 Koleksi Aksesori Handmade Terbaru
                </span>
                <h1 class="font-heading text-4xl sm:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                    Hiasi Harimu Dengan <span class="bg-gradient-to-r from-brand-blue via-brand-purple to-brand-pink bg-clip-text text-transparent">Aksesori Cantik</span>
                </h1>
                <p class="text-base sm:text-lg text-gray-500 dark:text-gray-400 max-w-lg mx-auto lg:mx-0">
                    Temukan bagcharm, bracelet, keychain, dan phonestrap yang dibuat dengan penuh kasih sayang untuk mempermanis gaya kasualmu sehari-hari.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('catalog') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full text-center font-bold bg-gradient-to-r from-brand-pink to-brand-purple text-white shadow-lg shadow-brand-purple/20 hover:shadow-xl hover:shadow-brand-purple/30 transition duration-200">
                        Belanja Sekarang
                    </a>
                    <a href="{{ route('custom-order.create') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full text-center font-bold bg-white dark:bg-gray-800 text-brand-purple dark:text-brand-pink hover:bg-brand-pink/5 border border-brand-pink/30 transition duration-200">
                        Custom Desainmu 💌
                    </a>
                </div>
            </div>
            
            <!-- Hero Image / Visual -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative w-72 h-72 sm:w-96 sm:h-96 rounded-full bg-gradient-to-tr from-brand-pink/30 to-brand-blue/30 dark:from-brand-pink/10 dark:to-brand-blue/10 flex items-center justify-center shadow-inner">
                    <!-- Main image placeholder/display -->
                    <img src="{{ asset('images/indeximage.jpg') }}" alt="Wigglepop Accessories" class="w-64 h-64 sm:w-80 sm:h-80 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-xl scale-100 hover:scale-105 transition duration-500">
                    
                    <!-- Decorative Floating Badges -->
                    <div class="absolute top-8 -left-4 bg-white dark:bg-gray-800 px-4 py-2 rounded-2xl shadow-md border border-brand-pink/20 dark:border-gray-700 flex items-center gap-2 animate-bounce">
                        <span class="text-lg">✨</span>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">100% Handmade</span>
                    </div>
                    <div class="absolute bottom-8 -right-4 bg-white dark:bg-gray-800 px-4 py-2 rounded-2xl shadow-md border border-brand-pink/20 dark:border-gray-700 flex items-center gap-2 animate-pulse">
                        <span class="text-lg">💖</span>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">High Quality</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Grid Section -->
<section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="font-heading text-3xl font-bold text-gray-900 dark:text-white">Kategori Pilihan</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Pilih kategori aksesori yang sesuai dengan kebutuhanmu hari ini</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="group flex flex-col items-center p-6 bg-brand-pastelPink dark:bg-gray-800 rounded-3xl border border-brand-pink/15 dark:border-gray-700 hover:border-brand-purple hover:shadow-md transition duration-300">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden mb-4 bg-white shadow-inner flex items-center justify-center">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <span class="font-bold text-gray-800 dark:text-white text-sm text-center group-hover:text-brand-purple transition-colors">{{ $category->name }}</span>
                    <span class="text-xs text-gray-400 mt-1">{{ $category->products_count ?? $category->products()->count() }} Produk</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-16 bg-brand-pastelPink/30 dark:bg-gray-950/40 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="font-heading text-3xl font-bold text-gray-900 dark:text-white">Produk Terlaris</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Daftar aksesori terfavorit wigglepop mates</p>
            </div>
            <a href="{{ route('catalog') }}" class="flex items-center gap-1 font-semibold text-brand-purple dark:text-brand-pink hover:underline">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="group bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-brand-pink/20 dark:border-gray-800 hover:shadow-lg transition duration-300 flex flex-col h-full">
                    <!-- Image Container -->
                    <div class="relative aspect-square overflow-hidden bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                        @if($product->first_image)
                            <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white font-bold">
                                No Image
                            </div>
                        @endif
                        
                        <!-- Wishlist Toggle Button (Floating) -->
                        @auth
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-4 right-4">
                            @csrf
                            <button type="submit" class="p-2.5 rounded-full bg-white/85 dark:bg-gray-800/85 hover:bg-white dark:hover:bg-gray-800 text-red-500 shadow-md transition-all duration-200">
                                <i data-lucide="heart" class="w-4.5 h-4.5 fill-red-500"></i>
                            </button>
                        </form>
                        @endauth
                    </div>

                    <!-- Details -->
                    <div class="p-5 flex flex-col flex-grow">
                        <span class="text-xs font-semibold text-brand-purple dark:text-brand-pink tracking-wider uppercase mb-1">
                            {{ $product->category->name }}
                        </span>
                        <h3 class="font-heading font-bold text-gray-800 dark:text-white text-base group-hover:text-brand-purple transition-colors line-clamp-1">
                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">
                            {{ $product->description }}
                        </p>
                        
                        <div class="mt-auto pt-4 flex items-center justify-between border-t border-brand-pink/10 dark:border-gray-800">
                            <span class="font-heading font-bold text-gray-900 dark:text-white text-lg">
                                {{ $product->formatted_price }}
                            </span>
                            
                            <!-- Add to Cart AJAX or Action -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-xl bg-brand-pink/10 hover:bg-brand-pink/20 text-brand-purple dark:text-brand-pink transition duration-200" title="Tambah ke Keranjang">
                                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Custom Order Callout -->
<section class="py-20 bg-gradient-to-tr from-brand-purple/20 via-brand-pink/20 to-brand-sky/20 dark:from-gray-900 dark:to-gray-950 text-center relative overflow-hidden transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
        <h2 class="font-heading text-3xl sm:text-5xl font-bold text-gray-900 dark:text-white">Punya Desain Impian Sendiri? 🎀</h2>
        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Kamu bisa custom paduan warna, pilihan manik-manik, gantungan inisial nama, atau mengirimkan gambar referensi yang kamu sukai. Kami akan mewujudkannya khusus untukmu!
        </p>
        <div>
            <a href="{{ route('custom-order.create') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold bg-gradient-to-r from-brand-purple to-brand-pink text-white shadow-lg shadow-brand-purple/20 hover:shadow-xl transition duration-200">
                <i data-lucide="sparkles" class="w-5 h-5"></i> Mulai Custom Order
            </a>
        </div>
    </div>
</section>
<!-- Testimonials Section -->
<section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-semibold bg-brand-pink/15 text-brand-purple dark:text-brand-pink border border-brand-pink/20 mb-4">
                💬 Kata Mereka
            </span>
            <h2 class="font-heading text-3xl font-bold text-gray-900 dark:text-white">Wigglepop Mates Bicara</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Ribuan pelanggan bahagia sudah merasakan keistimewaan aksesori Wigglepop</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($testimonials as $testimonial)
                <div class="group bg-brand-pastelPink/50 dark:bg-gray-800 rounded-3xl p-6 border border-brand-pink/15 dark:border-gray-700 hover:border-brand-purple/30 hover:shadow-md transition duration-300 flex flex-col gap-4">
                    <!-- Stars -->
                    <div class="flex gap-1">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg class="w-4 h-4 text-yellow-400 fill-yellow-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <!-- Quote -->
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed flex-grow">"{{ $testimonial['text'] }}"</p>
                    <!-- Name -->
                    <div class="flex items-center gap-3 pt-2 border-t border-brand-pink/10 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-brand-pink to-brand-purple flex items-center justify-center text-white font-bold text-xs">
                            {{ substr($testimonial['name'], 0, 1) }}
                        </div>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $testimonial['name'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
