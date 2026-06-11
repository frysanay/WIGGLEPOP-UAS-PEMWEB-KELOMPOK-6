@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Link -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-brand-purple">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Pesanan Saya
            </a>
            <span class="font-heading font-bold text-sm text-gray-700 dark:text-gray-300">
                Order ID: #WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Items and payment proof -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Items list -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Item Pesanan</h2>
                    <div class="divide-y divide-brand-pink/10 dark:divide-gray-800">
                        @foreach($order->orderItems as $item)
                            <div class="py-4 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                        @if($item->product && $item->product->first_image)
                                            <img src="{{ asset($item->product->first_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-[10px] font-bold">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 dark:text-white">{{ $item->product ? $item->product->name : $item->product_name }}</span>
                                        <span class="text-xs text-gray-400">Qty: {{ $item->quantity }} &times; Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-sm text-gray-900 dark:text-white">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Proof -->
                @if($order->payment_proof)
                    <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                        <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Bukti Pembayaran</h2>
                        <div class="max-w-xs aspect-[3/4] bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-full object-contain">
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Shipping Info & Status -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Status card -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Status Pesanan</h2>
                    <div class="flex items-center gap-2 mb-4">
                        @if($order->status === 'pending')
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-800 dark:bg-yellow-950/20 dark:text-yellow-400 border border-yellow-300">
                                Menunggu Konfirmasi
                            </span>
                        @elseif($order->status === 'confirmed')
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-800 dark:bg-blue-950/20 dark:text-blue-400 border border-blue-300">
                                Sedang Diproses
                            </span>
                        @elseif($order->status === 'shipped')
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-purple-50 text-brand-purple dark:bg-purple-950/20 dark:text-brand-pink border border-brand-pink/30">
                                Dalam Pengiriman
                            </span>
                        @elseif($order->status === 'delivered')
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-green-50 text-green-800 dark:bg-green-950/20 dark:text-green-400 border border-green-300">
                                Selesai
                            </span>
                        @else
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-800 dark:bg-red-950/20 dark:text-red-400 border border-red-300">
                                Dibatalkan
                            </span>
                        @endif
                    </div>

                    <div class="space-y-4 text-sm mt-6">
                        <div class="flex justify-between items-center text-xs text-gray-400">
                            <span>Metode Bayar:</span>
                            <span class="font-bold text-gray-700 dark:text-gray-300">QRIS / Transfer</span>
                        </div>
                        <div class="flex justify-between items-center text-xs text-gray-400">
                            <span>Tanggal Transaksi:</span>
                            <span class="font-bold text-gray-700 dark:text-gray-300">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-3">Tujuan Pengiriman</h2>
                    <p class="text-sm font-bold text-gray-900 dark:text-white mb-2">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                        {{ $order->shipping_address }}
                    </p>
                </div>

                <!-- Payment Summary -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
                    <h2 class="font-heading text-lg font-bold text-gray-900 dark:text-white mb-4">Ringkasan Pembayaran</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal:</span>
                            <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Biaya Kirim:</span>
                            <span class="font-bold text-green-500">FREE ✨</span>
                        </div>
                        <div class="border-t border-brand-pink/10 dark:border-gray-800 my-2 pt-2 flex justify-between text-base font-bold">
                            <span class="text-gray-900 dark:text-white">Total:</span>
                            <span class="text-brand-purple dark:text-brand-pink">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
