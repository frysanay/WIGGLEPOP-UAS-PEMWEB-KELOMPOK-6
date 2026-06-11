@extends('layouts.app')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-8">Pesanan Saya</h1>

        @if($orders->isEmpty())
            <div class="text-center py-16 bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800 transition-colors duration-300">
                <span class="text-5xl">📦</span>
                <h3 class="font-heading font-bold text-gray-800 dark:text-white text-xl mt-4">Belum Ada Transaksi</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Kamu belum pernah memesan produk di Wigglepop.</p>
                <a href="{{ route('catalog') }}" class="inline-block mt-4 px-6 py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-full text-sm">Belanja Sekarang</a>
            </div>
        @else
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800 shadow-sm overflow-hidden transition-colors duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-brand-pink/10 dark:border-gray-800 bg-gray-50 dark:bg-gray-800">
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">No. Order</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Pembayaran</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brand-pink/10 dark:divide-gray-800">
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-heading font-bold text-sm text-gray-900 dark:text-white">#WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-sm text-gray-800 dark:text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($order->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-50 dark:bg-yellow-950/20 text-yellow-800 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-900/30">
                                                Menunggu Konfirmasi
                                            </span>
                                        @elseif($order->status === 'confirmed')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-950/20 text-blue-800 dark:text-blue-400 border border-blue-200 dark:border-blue-900/30">
                                                Pesanan Diproses
                                            </span>
                                        @elseif($order->status === 'shipped')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 dark:bg-purple-950/20 text-brand-purple dark:text-brand-pink border border-brand-pink/20 dark:border-purple-900/30">
                                                Dalam Pengiriman
                                            </span>
                                        @elseif($order->status === 'delivered')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 dark:bg-green-950/20 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-900/30">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 dark:bg-red-950/20 text-red-800 dark:text-red-400 border border-red-200 dark:border-red-900/30">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold">
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-1 text-brand-purple dark:text-brand-pink hover:underline">
                                            Detail <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-brand-pink/10 dark:border-gray-800">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection
