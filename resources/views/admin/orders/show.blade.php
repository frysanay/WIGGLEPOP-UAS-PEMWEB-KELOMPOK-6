@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-4xl">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mt-1">
                Detail Pesanan #WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
            </h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Items List -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition">
                <h2 class="font-heading font-bold text-gray-900 dark:text-white text-base mb-4">Item Pesanan</h2>
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($order->orderItems as $item)
                        <div class="py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 flex-shrink-0">
                                    @if($item->product && $item->product->first_image)
                                        <img src="{{ asset($item->product->first_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr from-brand-sky to-brand-purple flex items-center justify-center text-white text-xs">🎀</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="block text-sm font-bold dark:text-white">{{ $item->product->name ?? 'Produk Dihapus' }}</span>
                                    <span class="text-xs text-gray-400">{{ $item->quantity }}x &times; Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <span class="font-bold text-sm dark:text-white">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-100 dark:border-gray-800 pt-3 mt-2 flex justify-between font-bold">
                    <span class="dark:text-white">Total Pembayaran:</span>
                    <span class="text-brand-purple dark:text-brand-pink text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Bukti Bayar -->
            @if($order->payment_proof)
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition">
                    <h2 class="font-heading font-bold text-gray-900 dark:text-white text-base mb-4">Bukti Pembayaran</h2>
                    <div class="max-w-xs border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Bayar" class="w-full object-contain">
                    </div>
                </div>
            @endif
        </div>

        <!-- Status & Info -->
        <div class="space-y-6">
            <!-- Update Status -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition">
                <h2 class="font-heading font-bold text-gray-900 dark:text-white text-base mb-4">Update Status</h2>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <select name="status" class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @foreach(['pending'=>'Pending','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','delivered'=>'Selesai','cancelled'=>'Dibatalkan'] as $val => $label)
                            <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl transition text-sm">
                        Simpan Status
                    </button>
                </form>
            </div>

            <!-- Customer Info -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition space-y-3">
                <h2 class="font-heading font-bold text-gray-900 dark:text-white text-base">Info Pelanggan</h2>
                <div>
                    <span class="text-xs text-gray-400">Nama</span>
                    <span class="block font-semibold text-sm dark:text-white">{{ $order->user->name }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-400">Email</span>
                    <span class="block font-semibold text-sm dark:text-white">{{ $order->user->email }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-400">Alamat Pengiriman</span>
                    <span class="block text-sm dark:text-white leading-relaxed">{{ $order->shipping_address }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
