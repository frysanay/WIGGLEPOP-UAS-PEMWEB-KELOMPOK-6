@extends('layouts.app')

@section('title', 'Bayar Custom Order #CO-' . str_pad($customOrder->id, 4, '0', STR_PAD_LEFT) . ' - Wigglepop')

@section('content')
<div class="py-12 bg-brand-pastelPink/20 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Link -->
        <div class="mb-6">
            <a href="{{ route('custom-order.index') }}"
               class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-brand-purple transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Custom Order
            </a>
        </div>

        <!-- Order Summary -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm mb-6 transition-colors duration-300">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-pink to-brand-purple flex items-center justify-center">
                    <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h1 class="font-heading font-bold text-gray-900 dark:text-white">
                        Pembayaran Custom Order
                    </h1>
                    <p class="text-xs text-gray-400">#CO-{{ str_pad($customOrder->id, 4, '0', STR_PAD_LEFT) }} &bull; {{ $customOrder->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl text-sm text-gray-600 dark:text-gray-400 mb-5">
                <span class="font-semibold text-gray-700 dark:text-gray-300 block mb-1">Deskripsi Desain:</span>
                {{ $customOrder->description }}
            </div>

            <!-- Harga Final -->
            <div class="flex items-center justify-between py-4 border-t border-brand-pink/10 dark:border-gray-800">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total yang harus dibayar</p>
                    @if($customOrder->budget)
                    <p class="text-xs text-gray-400">Estimasi Budget Kamu: Rp {{ number_format($customOrder->budget, 0, ',', '.') }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <span class="font-heading font-bold text-2xl text-brand-purple dark:text-brand-pink">
                        Rp {{ number_format($customOrder->final_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            @if($customOrder->admin_note)
            <div class="p-3 bg-blue-50 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-800/30 rounded-2xl mt-3">
                <span class="text-xs font-semibold text-blue-600 dark:text-blue-400">Catatan dari Tim Wigglepop:</span>
                <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">{{ $customOrder->admin_note }}</p>
            </div>
            @endif
        </div>

        <!-- Informasi Pembayaran -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm mb-6 transition-colors duration-300">
            <h2 class="font-heading font-bold text-gray-900 dark:text-white mb-4">Cara Pembayaran</h2>
            <div class="space-y-4">
                <p class="text-xs text-gray-500 dark:text-gray-400">Silakan transfer ke salah satu rekening berikut, kemudian upload bukti pembayaranmu:</p>

                <div class="p-4 bg-brand-pastelPink/50 dark:bg-gray-800 rounded-2xl border border-brand-pink/15">
                    <span class="block text-xs font-semibold text-gray-400">Transfer Bank:</span>
                    <span class="block text-sm font-bold text-gray-900 dark:text-white mt-1">Bank Central Asia (BCA)</span>
                    <span class="block text-xl font-extrabold text-brand-purple dark:text-brand-pink tracking-wide">123-456-7890</span>
                    <span class="block text-xs text-gray-400">a/n PT Wigglepop Cantik Indonesia</span>
                </div>

                <div class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-800 border border-dashed border-gray-300 dark:border-gray-700 rounded-2xl">
                    <span class="block text-xs font-semibold text-gray-500 mb-2">Atau pindai QRIS Resmi:</span>
                    <div class="w-36 h-36 bg-white border border-gray-200 rounded-lg p-2 flex items-center justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=WigglepopCustomOrderPayment{{ $customOrder->id }}" alt="QRIS" class="w-full h-full object-contain">
                    </div>
                    <span class="text-[10px] text-gray-400 mt-2">QRIS Wigglepop - GPN Indonesia</span>
                </div>
            </div>
        </div>

        <!-- Upload Bukti Pembayaran -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-brand-pink/20 dark:border-gray-800 shadow-sm transition-colors duration-300">
            <h2 class="font-heading font-bold text-gray-900 dark:text-white mb-5">Upload Bukti Pembayaran</h2>

            <form action="{{ route('custom-order.submit-payment', $customOrder->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label for="payment_proof" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Foto / Screenshot Bukti Transfer <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-pink/15 file:text-brand-purple dark:file:bg-gray-800 dark:file:text-brand-pink hover:file:bg-brand-pink/25 transition">
                    <p class="text-xs text-gray-400">Format: JPG, PNG. Maks. 2MB. Pastikan nominal dan tanggal transfer terlihat jelas.</p>
                    @error('payment_proof')
                        <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview gambar sebelum upload -->
                <div id="preview-container" class="hidden">
                    <span class="text-xs font-semibold text-gray-400">Preview:</span>
                    <img id="preview-image" src="" alt="Preview" class="mt-2 max-h-48 rounded-2xl border border-brand-pink/20 object-contain">
                </div>

                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-2xl shadow-lg shadow-brand-purple/20 hover:shadow-xl transition duration-200">
                    <i data-lucide="send" class="w-5 h-5 inline mr-2"></i>
                    Kirim Bukti Pembayaran
                </button>

                <p class="text-center text-xs text-gray-400">
                    Setelah bukti diterima, tim kami akan segera memverifikasi dan memproses pesananmu. 💌
                </p>
            </form>
        </div>

    </div>
</div>

<script>
    // Preview gambar sebelum diupload
    document.getElementById('payment_proof').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview-image').src = ev.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
