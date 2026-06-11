@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-8">Wishlist Saya</h1>

        @if($wishlists->isEmpty())
            <div class="text-center py-16 bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800 transition-colors duration-300">
                <span class="text-5xl">💖</span>
                <h3 class="font-heading font-bold text-gray-800 dark:text-white text-xl mt-4">Wishlist Kamu Kosong</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Belum ada produk yang kamu sukai. Jelajahi katalog kami sekarang!</p>
                <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-full text-sm">Cari Aksesori</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    @if($product)
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
                                
                                <!-- Remove from Wishlist Toggle Button -->
                                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-4 right-4">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-full bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-950/20 text-red-500 shadow-md transition duration-200" title="Hapus dari Wishlist">
                                        <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Details -->
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="text-xs font-semibold text-brand-purple dark:text-brand-pink tracking-wider uppercase mb-1">{{ $product->category->name }}</span>
                                <h3 class="font-heading font-bold text-gray-800 dark:text-white text-base group-hover:text-brand-purple transition-colors line-clamp-1">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                
                                <div class="mt-auto pt-4 flex items-center justify-between border-t border-brand-pink/10 dark:border-gray-800">
                                    <span class="font-heading font-bold text-gray-900 dark:text-white text-base">
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
                    @endif
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
