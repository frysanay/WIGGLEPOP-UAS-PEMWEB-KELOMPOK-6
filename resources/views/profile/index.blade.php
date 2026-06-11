@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-8">Pengaturan Profil</h1>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <!-- Left Side: Profile Avatar Card -->
            <div class="md:col-span-4 bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm text-center transition-colors duration-300 h-fit">
                <div class="relative w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-brand-pink/20 dark:border-gray-800 mb-4 bg-gray-50 flex items-center justify-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-brand-pink to-brand-purple text-white flex items-center justify-center font-bold text-4xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <h3 class="font-heading font-bold text-gray-900 dark:text-white text-base">{{ $user->name }}</h3>
                <span class="text-xs text-gray-400 block mt-1">{{ $user->email }}</span>
                <span class="inline-block mt-3 px-3 py-1 bg-brand-purple/10 text-brand-purple dark:text-brand-pink rounded-full text-xs font-semibold uppercase tracking-wider">
                    {{ $user->role }}
                </span>
            </div>

            <!-- Right Side: Edit Form -->
            <div class="md:col-span-8 bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-6">Ubah Data Diri</h2>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <!-- Avatar Upload -->
                    <div class="space-y-1.5">
                        <label for="avatar" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Ganti Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:bg-gray-800 dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                        @error('avatar')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="space-y-1.5">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor Telepon / WA</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="space-y-1.5">
                        <label for="address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Pengiriman Default</label>
                        <textarea id="address" name="address" rows="3"
                                  class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-brand-pink/10 dark:border-gray-800 my-6 pt-6">
                        <h3 class="font-heading font-semibold text-gray-900 dark:text-white text-base mb-4">Ganti Password (Kosongkan jika tidak diubah)</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div class="space-y-1.5">
                                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password Baru</label>
                                <input type="password" id="password" name="password"
                                       class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="space-y-1.5">
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/15 hover:shadow-lg transition duration-200">
                        Simpan Perubahan ✨
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
