@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Pesan Masuk</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Semua pesan dari form kontak pelanggan</p>
        </div>
        <form method="GET" action="{{ route('admin.contacts.index') }}">
            <select name="filter" onchange="this.form.submit()" class="px-3 py-2 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                <option value="">Semua Pesan</option>
                <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
            </select>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Pengirim</th>
                        <th class="px-6 py-4">Subjek</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'bg-brand-pink/5 dark:bg-pink-950/10' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <span class="block font-{{ !$contact->is_read ? 'extrabold' : 'semibold' }} dark:text-white">{{ $contact->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $contact->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate {{ !$contact->is_read ? 'font-bold dark:text-white' : 'text-gray-600 dark:text-gray-400' }}">
                                {{ $contact->subject }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!$contact->is_read)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-brand-pink/15 text-brand-purple dark:text-brand-pink border border-brand-pink/30">Baru</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">Dibaca</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-400">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2 text-sm">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Baca</a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($contacts->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $contacts->links() }}</div>
        @endif
    </div>
</div>
@endsection
