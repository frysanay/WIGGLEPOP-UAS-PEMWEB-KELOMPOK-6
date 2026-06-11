@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-2xl">
    <div>
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gray-500 hover:text-brand-purple">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Pesan Masuk
        </a>
        <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white mt-1">Detail Pesan</h1>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 md:p-8 border border-gray-200 dark:border-gray-800 shadow-sm transition space-y-6">
        <!-- Header Info -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-heading text-lg font-bold dark:text-white">{{ $contact->subject }}</h2>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span class="font-semibold dark:text-gray-300">{{ $contact->name }}</span>
                    <span>&bull;</span>
                    <span>{{ $contact->email }}</span>
                </div>
                <p class="text-xs text-gray-400 mt-1">{{ $contact->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            @if($contact->is_read)
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200 flex-shrink-0">Sudah Dibaca</span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-pink/15 text-brand-purple dark:text-brand-pink border border-brand-pink/30 flex-shrink-0">Baru</span>
            @endif
        </div>

        <!-- Message Body -->
        <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>

        <!-- Actions -->
        <div class="border-t border-gray-100 dark:border-gray-800 pt-4 flex flex-wrap gap-3">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject) }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-brand-pink to-brand-purple text-white font-bold rounded-xl text-sm">
                <i data-lucide="reply" class="w-4 h-4"></i> Balas via Email
            </a>
            @if(!$contact->is_read)
                <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 border border-green-200 font-bold rounded-xl text-sm hover:bg-green-100 transition">
                        <i data-lucide="check" class="w-4 h-4"></i> Tandai Sudah Dibaca
                    </button>
                </form>
            @endif
            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 border border-red-200 font-bold rounded-xl text-sm hover:bg-red-100 transition">
                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
