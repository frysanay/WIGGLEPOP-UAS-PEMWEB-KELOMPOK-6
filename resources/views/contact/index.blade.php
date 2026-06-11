@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <!-- Shop Contact Info -->
            <div class="col-span-1 md:col-span-2 bg-gradient-to-tr from-brand-pink/20 to-brand-purple/20 dark:from-gray-900 dark:to-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm flex flex-col justify-between transition-colors duration-300">
                <div class="space-y-6">
                    <span class="text-3xl">👋</span>
                    <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white leading-tight">
                        Hubungi Wigglepop
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Ada pertanyaan mengenai produk, pengiriman, custom order, atau tawaran kolaborasi? Kirimkan pesanmu sekarang!
                    </p>

                    <div class="space-y-4 pt-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-white dark:bg-gray-800 rounded-xl text-brand-blue shadow-sm">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-400">Email Toko</span>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">hello@wigglepop.id</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-white dark:bg-gray-800 rounded-xl text-brand-purple shadow-sm">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-400">WhatsApp / Telepon</span>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">+62 812 3456 7890</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-white dark:bg-gray-800 rounded-xl text-brand-pink shadow-sm">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-400">Workshop Studio</span>
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Jakarta, Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="pt-8 border-t border-brand-pink/20 dark:border-gray-800 flex items-center gap-4 text-gray-600 dark:text-gray-300">
                    <a href="#" class="p-2 bg-white dark:bg-gray-800 rounded-full hover:text-brand-purple shadow-sm transition"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="p-2 bg-white dark:bg-gray-800 rounded-full hover:text-brand-purple shadow-sm transition"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                    <a href="#" class="p-2 bg-white dark:bg-gray-800 rounded-full hover:text-brand-purple shadow-sm transition"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-span-1 md:col-span-3 bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-white mb-6">Kirim Pesan</h2>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Subjek</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('subject') border-red-500 @enderror">
                        @error('subject')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Isi Pesan</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/15 hover:shadow-lg transition duration-200">
                        Kirim Pesan 💌
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
