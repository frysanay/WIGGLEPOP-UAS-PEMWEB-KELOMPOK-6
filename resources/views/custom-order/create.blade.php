@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Workflow Guide -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm mb-10 transition-colors duration-300 text-center">
            <span class="text-3xl">🎨</span>
            <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
                Cara Kerja Custom Order
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xl mx-auto">
                Wujudkan kreasi gantungan kunci, gelang, phone strap, atau bagcharm impianmu melalui 5 langkah mudah berikut ini:
            </p>
            
            <!-- Steps Grid -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-8">
                <div class="flex flex-col items-center p-3 bg-brand-pastelPink/40 dark:bg-gray-800 rounded-2xl border border-brand-pink/10">
                    <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex items-center justify-center font-bold text-sm">1</div>
                    <span class="font-bold text-xs mt-2 dark:text-white">Kirim Detail</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Isi deskripsi & budget</span>
                </div>
                <div class="flex flex-col items-center p-3 bg-brand-pastelPink/40 dark:bg-gray-800 rounded-2xl border border-brand-pink/10">
                    <div class="w-8 h-8 rounded-full bg-brand-pink text-white flex items-center justify-center font-bold text-sm">2</div>
                    <span class="font-bold text-xs mt-2 dark:text-white">Pembayaran</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Bayar sesuai budget diajukan</span>
                </div>
                <div class="flex flex-col items-center p-3 bg-brand-pastelPink/40 dark:bg-gray-800 rounded-2xl border border-brand-pink/10">
                    <div class="w-8 h-8 rounded-full bg-brand-purple text-white flex items-center justify-center font-bold text-sm">3</div>
                    <span class="font-bold text-xs mt-2 dark:text-white">Review Desain</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Tim kami memverifikasi desain</span>
                </div>
                <div class="flex flex-col items-center p-3 bg-brand-pastelPink/40 dark:bg-gray-800 rounded-2xl border border-brand-pink/10">
                    <div class="w-8 h-8 rounded-full bg-brand-sky text-gray-700 flex items-center justify-center font-bold text-sm">4</div>
                    <span class="font-bold text-xs mt-2 dark:text-white">Pembuatan</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Proses pengerjaan handmade</span>
                </div>
                <div class="flex flex-col items-center p-3 bg-brand-pastelPink/40 dark:bg-gray-800 rounded-2xl border border-brand-pink/10">
                    <div class="w-8 h-8 rounded-full bg-green-400 text-white flex items-center justify-center font-bold text-sm">5</div>
                    <span class="font-bold text-xs mt-2 dark:text-white">Pengiriman</span>
                    <span class="text-[10px] text-gray-400 mt-0.5">Kirim ke alamat tujuan</span>
                </div>
            </div>
        </div>

        <!-- Custom Order Form -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
            <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-white mb-6">Form Pengajuan Custom Order</h2>
            
            <form action="{{ route('custom-order.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Deskripsi Desain Impianmu <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="5" required 
                              placeholder="Contoh: Saya ingin phone strap warna pink & ungu pastel, pakai gantungan bentuk bunga besar di ujungnya, dan tambahan manik-manik nama huruf akrilik 'CHELSEA'..."
                              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-400">Jelaskan sejelas mungkin mengenai jenis aksesori, warna dominan, bahan, manik-manik nama, dsb (minimal 20 karakter).</p>
                    @error('description')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reference Image -->
                <div class="space-y-2">
                    <label for="reference_image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Gambar Referensi / Contoh Desain (Opsional)
                    </label>
                    <input type="file" id="reference_image" name="reference_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:bg-gray-800 dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                    <p class="text-xs text-gray-400">Format: JPG, PNG, atau WEBP. Maksimal ukuran file: 2MB.</p>
                    @error('reference_image')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Budget -->
                <div class="space-y-2">
                    <label for="budget" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Estimasi Budget (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="budget" name="budget" value="{{ old('budget') }}" min="10000" placeholder="Misal: 50000" required
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('budget') border-red-500 @enderror">
                    <p class="text-xs text-gray-400">Tuliskan nominal budget yang kamu anggarkan. Kamu akan langsung membayar sejumlah ini setelah menekan tombol kirim di bawah.</p>
                    @error('budget')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/15 hover:shadow-lg transition duration-200">
                        Kirim Pengajuan & Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
