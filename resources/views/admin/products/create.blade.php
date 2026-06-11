@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <!-- Back Link & Header -->
    <div class="space-y-2">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Produk
        </a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Tambah Produk Baru</h1>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-gray-300/20 dark:border-gray-800 shadow-sm transition">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Product Name -->
            <div class="space-y-1.5">
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Colorful Beads Phone Strap"
                       class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="space-y-1.5">
                <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Kategori</label>
                <select id="category_id" name="category_id" required
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('category_id') border-red-500 @enderror">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-1.5">
                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Deskripsi Produk</label>
                <textarea id="description" name="description" rows="4" placeholder="Jelaskan detail spesifikasi produk, keunikan, bahan manik-manik, dsb..."
                          class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Price -->
                <div class="space-y-1.5">
                    <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" placeholder="Misal: 35000"
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="space-y-1.5">
                    <label for="stock" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Stok (Pcs)</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" required min="0" placeholder="Misal: 50"
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Weight -->
                <div class="space-y-1.5">
                    <label for="weight" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Berat (Gram)</label>
                    <input type="number" id="weight" name="weight" value="{{ old('weight', 20) }}" min="0" placeholder="Misal: 20"
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('weight') border-red-500 @enderror">
                    @error('weight')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Multiple Images -->
            <div class="space-y-1.5">
                <label for="images" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Foto Produk</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:bg-gray-800 dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                <p class="text-xs text-gray-400">Harap upload minimal 1 foto produk. Kamu bisa memilih beberapa foto sekaligus.</p>
                @error('images')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Active -->
            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" checked
                       class="w-4 h-4 text-brand-purple border-gray-300 rounded focus:ring-brand-purple">
                <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Tampilkan / Aktifkan di Toko</label>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl shadow-md hover:shadow-lg transition">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
