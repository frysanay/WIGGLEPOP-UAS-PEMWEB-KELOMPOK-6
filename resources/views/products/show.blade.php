@extends('layouts.app')

@section('title', $product->name . ' - Wigglepop')
@section('meta_description', $product->description ?? 'Beli ' . $product->name . ' dari Wigglepop - aksesori handmade berkualitas tinggi.')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Link -->
        <div class="mb-6">
            <a href="{{ route('catalog') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-brand-purple">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Katalog
            </a>
        </div>

        <!-- Product Grid Details -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300 grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Product Images -->
            <div class="space-y-4">
                <div class="aspect-square bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden flex items-center justify-center border border-brand-pink/10 dark:border-gray-800">
                    @if($product->first_image)
                        <img id="main-product-image" src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white font-bold">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Multiple images gallery if available -->
                @if(is_array($product->images) && count($product->images) > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->images as $img)
                            <button onclick="changeMainImage('{{ asset($img) }}')" class="aspect-square bg-gray-50 rounded-xl overflow-hidden border border-brand-pink/10 hover:border-brand-purple transition duration-200">
                                <img src="{{ asset($img) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Specs & Forms -->
            <div class="flex flex-col justify-between">
                <div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-brand-pink/15 text-brand-purple dark:text-brand-pink border border-brand-pink/20 mb-4">
                        {{ $product->category->name }}
                    </span>

                    <h1 class="font-heading text-2xl sm:text-4xl font-bold text-gray-900 dark:text-white leading-snug mb-2">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-center gap-4 mb-6">
                        <span class="font-heading font-bold text-2xl sm:text-3xl text-gray-900 dark:text-white">
                            {{ $product->formatted_price }}
                        </span>
                        
                        <div class="flex items-center gap-1 bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800/30 px-3 py-1 rounded-full text-xs font-semibold text-green-700 dark:text-green-300">
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            Stok: {{ $product->stock }}
                        </div>
                    </div>

                    <div class="border-t border-brand-pink/10 dark:border-gray-800 my-6"></div>

                    <div class="space-y-4">
                        <h3 class="font-heading font-semibold text-gray-800 dark:text-white text-base">Deskripsi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            {{ $product->description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-brand-pink/10 dark:border-gray-800 space-y-4">
                    @if($product->category->slug === 'custom')
                        {{-- Produk Custom: arahkan ke modul Custom Order --}}
                        <div class="p-4 bg-gradient-to-br from-brand-pastelPink/60 to-brand-pastelPurple/60 dark:from-gray-800 dark:to-gray-800 border border-brand-pink/20 dark:border-gray-700 rounded-2xl space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">🎨</span>
                                <div>
                                    <p class="font-heading font-bold text-gray-900 dark:text-white text-sm">Produk Custom Design</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Harga menyesuaikan desain dan detail pesananmu</p>
                                </div>
                            </div>
                        </div>

                        @auth
                        <a href="{{ route('custom-order.create') }}"
                           class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/10 hover:shadow-lg transition duration-200">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                            Buat Custom Order Sekarang
                        </a>
                        <a href="{{ route('custom-order.index') }}"
                           class="flex items-center justify-center gap-2 w-full py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 hover:bg-brand-pink/5 text-gray-700 dark:text-gray-300 font-bold rounded-2xl transition duration-200">
                            <i data-lucide="list" class="w-5 h-5"></i>
                            Lihat Custom Order Saya
                        </a>
                        @else
                        <a href="{{ route('login') }}"
                           class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition duration-200">
                            <i data-lucide="log-in" class="w-5 h-5"></i> Masuk untuk Custom Order
                        </a>
                        @endauth
                    @else
                        {{-- Produk Normal: form tambah ke keranjang --}}
                        @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center gap-3">
                            @csrf
                            <div class="w-24">
                                <label for="quantity" class="sr-only">Kuantitas</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1"
                                       class="w-full px-3 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-center font-bold text-sm outline-none dark:text-white">
                            </div>
                            <button type="submit" class="flex-grow py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/10 hover:shadow-lg transition duration-200">
                                Tambah ke Keranjang
                            </button>
                        </form>

                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 hover:bg-brand-pink/5 text-gray-700 dark:text-gray-300 font-bold rounded-2xl transition duration-200">
                                <i data-lucide="heart" class="w-5 h-5 {{ $inWishlist ? 'fill-red-500 text-red-500' : '' }}"></i>
                                {{ $inWishlist ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition duration-200">
                            <i data-lucide="log-in" class="w-5 h-5"></i> Masuk untuk Beli
                        </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($related->isNotEmpty())
            <div class="mt-16">
                <h2 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mb-8">Rekomendasi Produk Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($related as $relProduct)
                        <div class="group bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-brand-pink/20 dark:border-gray-800 hover:shadow-lg transition duration-300 flex flex-col h-full">
                            <div class="relative aspect-square overflow-hidden bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                                @if($relProduct->first_image)
                                    <img src="{{ asset($relProduct->first_image) }}" alt="{{ $relProduct->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white font-bold">
                                        No Image
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="text-xs font-semibold text-brand-purple dark:text-brand-pink tracking-wider mb-1">{{ $relProduct->category->name }}</span>
                                <h3 class="font-heading font-bold text-gray-800 dark:text-white text-base group-hover:text-brand-purple transition-colors line-clamp-1">
                                    <a href="{{ route('products.show', $relProduct->slug) }}">{{ $relProduct->name }}</a>
                                </h3>
                                <div class="mt-auto pt-4 flex items-center justify-between border-t border-brand-pink/10 dark:border-gray-800">
                                    <span class="font-heading font-bold text-gray-900 dark:text-white text-base">
                                        {{ $relProduct->formatted_price }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<script>
    function changeMainImage(url) {
        document.getElementById('main-product-image').src = url;
    }
</script>
@endsection
