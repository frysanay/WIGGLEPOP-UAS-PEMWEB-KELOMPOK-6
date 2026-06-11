@extends('layouts.app')

@section('title', 'Katalog Aksesori - Wigglepop')
@section('meta_description', 'Jelajahi koleksi aksesori handmade Wigglepop - bagcharm, bracelet, keychain, dan phonestrap dengan berbagai pilihan warna dan desain yang lucu.')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search & Filter Controls -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm mb-8 transition-colors duration-300">
            <form action="{{ route('catalog') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <!-- Search Input -->
                <div class="relative md:col-span-2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aksesori favoritmu..." 
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm transition outline-none dark:text-white">
                </div>

                <!-- Sort Filter -->
                <div>
                    <select name="sort" onchange="this.form.submit()" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm transition outline-none dark:text-white">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition duration-200">
                        Filter Hasil
                    </button>
                </div>

                <!-- Preserve Category Filter in Form if active -->
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Categories Filter -->
            <div class="col-span-1 space-y-6">
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h3 class="font-heading font-bold text-gray-900 dark:text-white text-lg mb-4">Kategori</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('catalog', request()->except('category', 'page')) }}" 
                           class="flex items-center justify-between px-4 py-2.5 rounded-xl font-medium text-sm transition {{ !request('category') ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-400 hover:bg-brand-pink/5' }}">
                            <span>Semua Kategori</span>
                            <span class="text-xs text-gray-400"></span>
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('catalog', array_merge(request()->query(), ['category' => $cat->slug, 'page' => 1])) }}" 
                               class="flex items-center justify-between px-4 py-2.5 rounded-xl font-medium text-sm transition {{ request('category') == $cat->slug ? 'bg-brand-purple/10 text-brand-purple dark:text-brand-pink' : 'text-gray-600 dark:text-gray-400 hover:bg-brand-pink/5' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs text-gray-400">{{ $cat->products_count ?? $cat->products()->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-span-1 lg:col-span-3 space-y-8">
                @if($products->isEmpty())
                    <div class="text-center py-16 bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800">
                        <span class="text-5xl">🥺</span>
                        <h3 class="font-heading font-bold text-gray-800 dark:text-white text-xl mt-4">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Cobalah gunakan kata kunci pencarian atau kategori lain.</p>
                        <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2 bg-brand-purple text-white font-semibold rounded-full text-sm">Reset Filter</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="group bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-brand-pink/20 dark:border-gray-800 hover:shadow-lg transition duration-300 flex flex-col h-full">
                                <!-- Image -->
                                <div class="relative aspect-square overflow-hidden bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                                    @if($product->first_image)
                                        <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white font-bold">
                                            No Image
                                        </div>
                                    @endif
                                    
                                    <!-- Wishlist Button -->
                                    @auth
                                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-4 right-4">
                                        @csrf
                                        <button type="submit" class="p-2.5 rounded-full bg-white/85 dark:bg-gray-800/85 hover:bg-white dark:hover:bg-gray-800 text-red-500 shadow-md transition duration-200">
                                            <i data-lucide="heart" class="w-4.5 h-4.5 {{ auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'fill-red-500 text-red-500' : 'text-gray-600 dark:text-gray-300' }}"></i>
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
                                        
                                        <!-- Add to Cart -->
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

                    <!-- Pagination Links -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
