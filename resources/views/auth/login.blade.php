@extends('layouts.app')

@section('content')
<div class="py-16 bg-brand-pastelPink/20 dark:bg-gray-950 flex items-center justify-center transition-colors duration-300">
    <div class="max-w-md w-full px-6">
        
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
            <!-- Header -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/wigglepop-logo.png') }}" alt="Wigglepop Logo" class="h-16 w-auto mx-auto mb-4">
                <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang Kembali!</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Masuk ke akun Wigglepop kamu</p>
            </div>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i data-lucide="mail" class="w-4.5 h-4.5"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com"
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i data-lucide="lock" class="w-4.5 h-4.5"></i>
                        </span>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password kamu"
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('password') border-red-500 @enderror">
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-brand-purple border-brand-pink/15 rounded focus:ring-brand-purple">
                    <label for="remember" class="ml-2 text-sm font-semibold text-gray-500 dark:text-gray-400">Ingat Saya</label>
                </div>

                <!-- Action Button -->
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/15 hover:shadow-lg transition duration-200">
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-6 pt-4 border-t border-brand-pink/10 dark:border-gray-800">
                <p class="text-sm text-gray-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-brand-purple dark:text-brand-pink hover:underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
