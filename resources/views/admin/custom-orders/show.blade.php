@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-3xl">
    <div>
        <a href="{{ route('admin.custom-orders.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mt-1">
            Detail Custom Order #CO-{{ str_pad($customOrder->id, 4, '0', STR_PAD_LEFT) }}
        </h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Detail Info -->
        <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition space-y-4">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pelanggan</span>
                <p class="font-bold text-gray-900 dark:text-white mt-1">{{ $customOrder->user->name }}</p>
                <p class="text-sm text-gray-400">{{ $customOrder->user->email }} &bull; {{ $customOrder->user->phone }}</p>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Deskripsi Desain</span>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $customOrder->description }}</p>
            </div>

            @if($customOrder->budget)
                <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Estimasi Budget Pelanggan</span>
                    <p class="mt-1 font-bold text-gray-900 dark:text-white">Rp {{ number_format($customOrder->budget, 0, ',', '.') }}</p>
                </div>
            @endif

            @if($customOrder->final_price)
                <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga Final yang Ditetapkan</span>
                    <p class="mt-1 font-bold text-xl text-brand-purple dark:text-brand-pink">Rp {{ number_format($customOrder->final_price, 0, ',', '.') }}</p>
                </div>
            @endif

            @if($customOrder->reference_image)
                <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Gambar Referensi</span>
                    <div class="mt-2 max-w-xs border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $customOrder->reference_image) }}" alt="Referensi" class="w-full object-contain">
                    </div>
                </div>
            @endif

            @if($customOrder->payment_proof)
                <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Bukti Pembayaran</span>
                    <div class="mt-2 max-w-xs border-2 border-green-300 dark:border-green-700 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $customOrder->payment_proof) }}" alt="Bukti Bayar" class="w-full object-contain">
                    </div>
                    <p class="text-xs text-green-600 dark:text-green-400 mt-1 font-semibold">✅ Bukti pembayaran telah diunggah</p>
                </div>
            @endif

            @if($customOrder->admin_note)
                <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Catatan Admin</span>
                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $customOrder->admin_note }}</p>
                </div>
            @endif
        </div>

        <!-- Update Status + Harga Final -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm transition h-fit">
            <h2 class="font-heading font-bold text-gray-900 dark:text-white text-base mb-4">Update Order</h2>
            <form action="{{ route('admin.custom-orders.update', $customOrder->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Status -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                        @foreach([
                            'pending'          => 'Pending (Menunggu Review)',
                            'awaiting_payment' => 'Menunggu Pembayaran',
                            'process'          => 'Sedang Dibuat',
                            'done'             => 'Selesai',
                            'cancelled'        => 'Dibatalkan',
                        ] as $val => $label)
                            <option value="{{ $val }}" {{ $customOrder->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-400 mt-1">
                        💡 Set ke <strong>Menunggu Pembayaran</strong> setelah harga final disepakati agar customer bisa upload bukti bayar.
                    </p>
                </div>

                <!-- Harga Final -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Harga Final (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400">Rp</span>
                        <input type="number" name="final_price" min="0" step="1000"
                               value="{{ $customOrder->final_price ? intval($customOrder->final_price) : '' }}"
                               placeholder="{{ $customOrder->budget ? intval($customOrder->budget) : '50000' }}"
                               class="w-full pl-9 pr-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">Isi setelah sepakat harga dengan customer.</p>
                </div>

                <!-- Catatan Admin -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Catatan untuk Customer</label>
                    <textarea name="admin_note" rows="3"
                              placeholder="Misal: Harga sudah termasuk ongkos kirim. Estimasi selesai 3 hari kerja..."
                              class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white resize-none">{{ $customOrder->admin_note }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl text-sm transition hover:opacity-90">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
