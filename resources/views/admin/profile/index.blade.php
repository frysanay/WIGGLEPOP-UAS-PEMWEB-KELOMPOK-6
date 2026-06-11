@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Profil Admin & Toko</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Avatar Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition text-center h-fit">
            <div class="relative w-24 h-24 mx-auto rounded-full overflow-hidden border-4 border-brand-pink/20 dark:border-gray-800 mb-3 bg-gray-50">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-tr from-brand-pink to-brand-purple flex items-center justify-center text-white font-bold text-3xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <h3 class="font-heading font-bold dark:text-white">{{ $user->name }}</h3>
            <p class="text-xs text-gray-400 mt-1">{{ $user->email }}</p>
            <span class="inline-block mt-2 px-3 py-1 bg-brand-purple/10 text-brand-purple dark:text-brand-pink rounded-full text-xs font-bold uppercase">Admin</span>
        </div>

        <!-- Edit Form -->
        <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-gray-200 dark:border-gray-800 shadow-sm transition">
            <h2 class="font-heading font-bold dark:text-white text-base mb-5">Edit Profil Admin</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('email') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Bio Toko</label>
                    <textarea name="bio" rows="3"
                              class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Link Instagram</label>
                        <input type="url" name="social_instagram" value="{{ old('social_instagram', $profile->social_links['instagram'] ?? '') }}"
                               placeholder="https://instagram.com/..."
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('social_instagram') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Link TikTok</label>
                        <input type="url" name="social_tiktok" value="{{ old('social_tiktok', $profile->social_links['tiktok'] ?? '') }}"
                               placeholder="https://tiktok.com/..."
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('social_tiktok') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">WhatsApp</label>
                        <input type="text" name="social_whatsapp" value="{{ old('social_whatsapp', $profile->social_links['whatsapp'] ?? '') }}"
                               placeholder="08xxxxxxxxxx"
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('social_whatsapp') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Ganti Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                    @error('avatar') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Password Baru (opsional)</label>
                        <input type="password" name="password"
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @error('password') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl shadow-md hover:shadow-lg transition">
                    Simpan Perubahan ✨
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
