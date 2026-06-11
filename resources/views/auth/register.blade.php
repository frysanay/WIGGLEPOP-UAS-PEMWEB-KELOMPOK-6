@extends('layouts.app')

@section('content')
<div class="py-16 bg-brand-pastelPink/20 dark:bg-gray-950 flex items-center justify-center transition-colors duration-300">
    <div class="max-w-md w-full px-6">
        
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
            <!-- Header -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/wigglepop-logo.png') }}" alt="Wigglepop Logo" class="h-16 w-auto mx-auto mb-4">
                <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Buat Akun Baru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Daftar sekarang untuk mulai berbelanja aksesori handmade</p>
            </div>

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Name -->
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-1">
                    <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor Telepon / WA</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Misal: 08123456789"
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="space-y-1">
                    <label for="address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Pengiriman</label>
                    <textarea id="address" name="address" rows="2" placeholder="Nama Jalan, Kelurahan, Kecamatan, Kota, Kode Pos"
                              class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white">
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/15 hover:shadow-lg transition duration-200">
                        Daftar Akun
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6 pt-4 border-t border-brand-pink/10 dark:border-gray-800">
                <p class="text-sm text-gray-500">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-brand-purple dark:text-brand-pink hover:underline">Masuk Di Sini</a>
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
