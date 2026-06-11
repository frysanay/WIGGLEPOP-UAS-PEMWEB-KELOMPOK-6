@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-8">Checkout Pesanan</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Order items list & Payment Directions -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Cart Summary -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Rincian Keranjang</h2>
                    <div class="divide-y divide-brand-pink/10 dark:divide-gray-800">
                        @foreach($cartItems as $item)
                            <div class="py-4 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                        @if($item['product']->first_image)
                                            <img src="{{ asset($item['product']->first_image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-[10px] font-bold">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 dark:text-white">{{ $item['product']->name }}</span>
                                        <span class="text-xs text-gray-400">Qty: {{ $item['quantity'] }} &times; {{ $item['product']->formatted_price }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="mt-1">
                                        @csrf
                                        <button type="submit" class="text-[10px] text-red-500 font-bold hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Directions -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Metode Pembayaran (QRIS / Transfer)</h2>
                    <div class="space-y-4">
                        <p class="text-xs text-gray-500">Silakan lakukan pembayaran ke rekening atau memindai QRIS resmi Wigglepop berikut:</p>
                        
                        <div class="p-4 bg-brand-pastelPink/50 dark:bg-gray-800 rounded-2xl border border-brand-pink/15">
                            <span class="block text-xs font-semibold text-gray-400">Pilihan Transfer Bank:</span>
                            <span class="block text-sm font-bold text-gray-900 dark:text-white mt-1">Bank Central Asia (BCA)</span>
                            <span class="block text-lg font-extrabold text-brand-purple dark:text-brand-pink tracking-wide">123-456-7890</span>
                            <span class="block text-xs text-gray-400">a/n PT Wigglepop Cantik Indonesia</span>
                        </div>

                        <div class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-800 border border-dashed border-gray-300 dark:border-gray-700 rounded-2xl">
                            <span class="block text-xs font-semibold text-gray-500 mb-2">Pindai QRIS Resmi:</span>
                            <!-- Mock QRIS code -->
                            <div class="w-40 h-40 bg-white border border-gray-200 rounded-lg p-2 flex items-center justify-center">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=WigglepopQRISPayment" alt="QRIS Code" class="w-full h-full object-contain">
                            </div>
                            <span class="text-[10px] text-gray-400 mt-2">QRIS Wigglepop - GPN Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Shipping Form & Upload proof -->
            <div class="lg:col-span-5">
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300 sticky top-24">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Pengiriman & Pembayaran</h2>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        
                        <!-- Shipping Address -->
                        <div class="space-y-1.5">
                            <label for="shipping_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat Lengkap Pengiriman</label>
                            <textarea id="shipping_address" name="shipping_address" rows="4" required 
                                      placeholder="Tuliskan nama jalan, kelurahan, kecamatan, kota, provinsi, dan kode pos tujuan."
                                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-brand-pink/15 dark:border-gray-700 focus:border-brand-purple focus:ring-1 focus:ring-brand-purple rounded-2xl text-sm outline-none dark:text-white @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Proof Upload -->
                        <div class="space-y-1.5">
                            <label for="payment_proof" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Upload Bukti Pembayaran</label>
                            <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:bg-gray-800 dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                            <p class="text-[10px] text-gray-400">Harap upload foto atau tangkapan layar struk transfer/bukti bayar QRIS yang valid.</p>
                            @error('payment_proof')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Final Summary & Submit -->
                        <div class="pt-4 border-t border-brand-pink/10 dark:border-gray-800 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Subtotal Belanja:</span>
                                <span class="font-bold text-gray-800 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Biaya Pengiriman:</span>
                                <span class="font-bold text-green-500">FREE ONGKIR ✨</span>
                            </div>
                            <div class="flex justify-between items-center border-t border-brand-pink/10 dark:border-gray-800 pt-3">
                                <span class="text-base font-bold text-gray-900 dark:text-white">Total Bayar:</span>
                                <span class="text-xl font-extrabold text-brand-purple dark:text-brand-pink">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            
                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-lg shadow-brand-purple/20 hover:shadow-xl transition duration-200">
                                Buat Pesanan & Bayar 🚀
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
