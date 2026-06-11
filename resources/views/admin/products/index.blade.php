@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Kelola Produk</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tambah, ubah, hapus, dan kelola semua stok produk Wigglepop</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/10 hover:shadow-lg transition">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk Baru
        </a>
    </div>

    <!-- Filter & Search Table -->
    <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm transition">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 mb-6">
            <div class="relative flex-grow">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." 
                       class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-brand-purple/10 dark:bg-brand-purple/20 text-brand-purple dark:text-brand-pink font-bold rounded-xl text-sm border border-brand-purple/20 dark:border-brand-pink/30 hover:bg-brand-purple/20 dark:hover:bg-brand-purple/30 transition">
                Cari
            </button>
        </form>

        <!-- Product Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                    @foreach($products as $product)
                        <tr class="{{ $product->trashed() ? 'bg-gray-50/50 dark:bg-gray-950/25 opacity-70' : '' }}">
                            <!-- Name & Image -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-800 flex-shrink-0">
                                        @if($product->first_image)
                                            <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-[10px] font-bold">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="block font-bold text-gray-900 dark:text-white">{{ $product->name }}</span>
                                        <span class="text-xs text-gray-400">Slug: {{ $product->slug }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                {{ $product->category->name }}
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4 whitespace-nowrap font-bold">
                                {{ $product->formatted_price }}
                            </td>

                            <!-- Stock -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-semibold {{ $product->stock <= 5 ? 'text-red-500 font-bold' : '' }}">{{ $product->stock }} pcs</span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->trashed())
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">Terhapus</span>
                                @elseif($product->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-800 border border-yellow-300">Draft</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                                @if($product->trashed())
                                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-600 font-bold hover:underline">Restore</button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.products.edit', $product->slug) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Ubah</a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 font-bold hover:underline">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
