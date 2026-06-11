@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mt-1">Detail Pengguna</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition text-center">
            <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-brand-pink to-brand-purple text-white flex items-center justify-center font-bold text-3xl mx-auto mb-3">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h3 class="font-heading font-bold dark:text-white">{{ $user->name }}</h3>
            <p class="text-xs text-gray-400 mt-1">{{ $user->email }}</p>
            <p class="text-xs text-gray-400 mt-0.5">{{ $user->phone ?? 'No Phone' }}</p>
            <div class="mt-3">
                @if($user->email_verified_at)
                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold">Aktif</span>
                @else
                    <span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-bold">Belum Verifikasi</span>
                @endif
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                <form action="{{ route('admin.users.toggle-active', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 rounded-xl text-sm font-bold {{ $user->email_verified_at ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-green-50 text-green-700 border border-green-200' }} transition hover:opacity-80">
                        {{ $user->email_verified_at ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Stats & Orders -->
        <div class="md:col-span-2 space-y-4">
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition">
                <h2 class="font-heading font-bold dark:text-white mb-3">Informasi Lengkap</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Alamat</span>
                        <span class="font-semibold dark:text-white text-right max-w-xs">{{ $user->address ?? 'Belum diisi' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Bergabung</span>
                        <span class="font-semibold dark:text-white">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Total Order</span>
                        <span class="font-semibold dark:text-white">{{ $user->orders->count() }} pesanan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Custom Orders</span>
                        <span class="font-semibold dark:text-white">{{ $user->customOrders->count() }} pengajuan</span>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            @if($user->orders->count() > 0)
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition">
                    <h2 class="font-heading font-bold dark:text-white mb-3">Riwayat Pesanan</h2>
                    <div class="space-y-2">
                        @foreach($user->orders->take(5) as $order)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <div>
                                    <span class="font-bold text-sm dark:text-white">#WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-xs text-gray-400 ml-2">{{ $order->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="block font-bold text-sm dark:text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-400">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
