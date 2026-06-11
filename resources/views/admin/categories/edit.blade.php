@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-2xl">
    <div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Kategori
        </a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mt-2">Ubah Kategori</h1>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-gray-200 dark:border-gray-800 shadow-sm transition">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white @error('name') border-red-500 @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-brand-purple rounded-xl text-sm outline-none dark:text-white">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            @if($category->image)
                <div>
                    <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Gambar Saat Ini:</span>
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                </div>
            @endif

            <div class="space-y-1.5">
                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Ganti Gambar (Opsional)</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl shadow-md hover:shadow-lg transition">
                Perbarui Kategori
            </button>
        </form>
    </div>
</div>
@endsection
