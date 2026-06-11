@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Kelola Kategori</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tambah dan kelola kategori produk Wigglepop</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori
        </a>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Jumlah Produk</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-800 flex-shrink-0">
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($category->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                <code class="text-xs bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-lg">{{ $category->slug }}</code>
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate text-gray-500">{{ $category->description ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 bg-brand-purple/10 text-brand-purple dark:text-brand-pink rounded-full text-xs font-bold">{{ $category->products_count }} produk</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2 text-sm">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Ubah</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Hapus kategori {{ $category->name }}? Kategori yang masih punya produk tidak bisa dihapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $categories->links() }}</div>
        @endif
    </div>
</div>
@endsection
