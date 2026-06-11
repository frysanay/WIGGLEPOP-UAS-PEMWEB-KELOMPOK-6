@extends('layouts.app')

@section('title', 'Custom Order Saya - Wigglepop')
@section('meta_description', 'Pantau status dan pembayaran custom order aksesori handmade Wigglepopmu.')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Custom Order Saya</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pantau status pengajuan desain kustommu</p>
            </div>
            <a href="{{ route('custom-order.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md shadow-brand-purple/20 hover:shadow-lg transition duration-200">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Buat Custom Order Baru
            </a>
        </div>

        @if($customOrders->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800 shadow-sm">
                <span class="text-6xl">🎨</span>
                <h3 class="font-heading font-bold text-gray-800 dark:text-white text-xl mt-4">Belum Ada Custom Order</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2 max-w-sm mx-auto">Wujudkan aksesori impianmu sekarang! Kirim desain dan kami akan membuatkannya.</p>
                <a href="{{ route('custom-order.create') }}"
                   class="inline-block mt-6 px-6 py-3 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition duration-200">
                    Buat Custom Order Pertamaku
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($customOrders as $co)
                    @php
                        $statusConfig = [
                            'pending'           => ['color' => 'yellow', 'bg' => 'bg-yellow-50 dark:bg-yellow-950/20', 'text' => 'text-yellow-800 dark:text-yellow-300', 'border' => 'border-yellow-200 dark:border-yellow-800/30', 'icon' => 'clock'],
                            'awaiting_payment'  => ['color' => 'orange', 'bg' => 'bg-orange-50 dark:bg-orange-950/20', 'text' => 'text-orange-800 dark:text-orange-300', 'border' => 'border-orange-200 dark:border-orange-800/30', 'icon' => 'credit-card'],
                            'process'           => ['color' => 'blue',   'bg' => 'bg-blue-50 dark:bg-blue-950/20',   'text' => 'text-blue-800 dark:text-blue-300',   'border' => 'border-blue-200 dark:border-blue-800/30',   'icon' => 'hammer'],
                            'done'              => ['color' => 'green',  'bg' => 'bg-green-50 dark:bg-green-950/20', 'text' => 'text-green-800 dark:text-green-300', 'border' => 'border-green-200 dark:border-green-800/30', 'icon' => 'check-circle'],
                            'cancelled'         => ['color' => 'red',    'bg' => 'bg-red-50 dark:bg-red-950/20',    'text' => 'text-red-800 dark:text-red-300',    'border' => 'border-red-200 dark:border-red-800/30',    'icon' => 'x-circle'],
                        ];
                        $cfg = $statusConfig[$co->status] ?? $statusConfig['pending'];
                    @endphp

                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-brand-pink/20 dark:border-gray-800 shadow-sm overflow-hidden transition-colors duration-300">
                        <!-- Header Card -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 p-6 border-b border-brand-pink/10 dark:border-gray-800">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-pink to-brand-purple flex items-center justify-center">
                                    <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <p class="font-heading font-bold text-gray-900 dark:text-white">
                                        Custom Order #CO-{{ str_pad($co->id, 4, '0', STR_PAD_LEFT) }}
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $co->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                                <i data-lucide="{{ $cfg['icon'] }}" class="w-3.5 h-3.5"></i>
                                {{ $co->status_label }}
                            </span>
                        </div>

                        <!-- Body Card -->
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Deskripsi -->
                            <div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Deskripsi Desain</span>
                                <p class="mt-1.5 text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3">{{ $co->description }}</p>
                            </div>

                            <!-- Info Harga & Status -->
                            <div class="space-y-3">
                                @if($co->budget)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Estimasi Budget:</span>
                                    <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($co->budget, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                @if($co->final_price)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Harga Final:</span>
                                    <span class="font-bold text-brand-purple dark:text-brand-pink text-base">Rp {{ number_format($co->final_price, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                @if($co->admin_note)
                                <div class="p-3 bg-blue-50 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-800/30 rounded-2xl">
                                    <span class="text-xs font-semibold text-blue-600 dark:text-blue-400">Catatan Admin:</span>
                                    <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">{{ $co->admin_note }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Footer -->
                        @if($co->status === 'awaiting_payment' && $co->final_price)
                        <div class="px-6 pb-6">
                            <div class="p-4 bg-orange-50 dark:bg-orange-950/20 border border-orange-200 dark:border-orange-800/30 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div>
                                    <p class="font-bold text-orange-800 dark:text-orange-300 text-sm">💳 Menunggu Pembayaranmu!</p>
                                    <p class="text-xs text-orange-600 dark:text-orange-400 mt-1">
                                        Silakan lakukan pembayaran sebesar <strong>Rp {{ number_format($co->final_price, 0, ',', '.') }}</strong> dan upload bukti transfer.
                                    </p>
                                </div>
                                <a href="{{ route('custom-order.pay', $co->id) }}"
                                   class="flex-shrink-0 inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-orange-400 to-brand-purple text-white font-bold rounded-xl shadow-md hover:shadow-lg transition duration-200 text-sm">
                                    <i data-lucide="upload" class="w-4 h-4"></i>
                                    Upload Bukti Bayar
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($co->status === 'process' && $co->payment_proof)
                        <div class="px-6 pb-6">
                            <div class="p-3 bg-blue-50 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-800/30 rounded-2xl flex items-center gap-3">
                                <i data-lucide="hammer" class="w-5 h-5 text-blue-500 flex-shrink-0"></i>
                                <p class="text-xs text-blue-700 dark:text-blue-300">Pembayaran diterima! Pesananmu sedang kami buat dengan penuh cinta. 💕</p>
                            </div>
                        </div>
                        @endif

                        @if($co->status === 'done')
                        <div class="px-6 pb-6">
                            <div class="p-3 bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800/30 rounded-2xl flex items-center gap-3">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-500 flex-shrink-0"></i>
                                <p class="text-xs text-green-700 dark:text-green-300">Pesanan selesai! Terima kasih sudah mempercayai Wigglepop. ✨</p>
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
