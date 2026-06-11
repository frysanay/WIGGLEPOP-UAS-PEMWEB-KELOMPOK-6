@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Kelola Pengguna</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Daftar semua akun pelanggan yang terdaftar</p>
        </div>
    </div>

    <!-- Search -->
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-3">
        <div class="relative flex-grow max-w-sm">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                   class="w-full pl-9 pr-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
        </div>
        <button type="submit" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-800 dark:text-white font-bold rounded-xl text-sm hover:bg-gray-200 transition">Cari</button>
    </form>

    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Telepon</th>
                        <th class="px-6 py-4">Total Order</th>
                        <th class="px-6 py-4">Status Akun</th>
                        <th class="px-6 py-4">Bergabung</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-brand-pink to-brand-purple text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="block font-semibold dark:text-white">{{ $user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-semibold dark:text-white">{{ $user->orders_count ?? $user->orders()->count() }} pesanan</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->email_verified_at)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">Aktif</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2 text-sm">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Detail</a>
                                <form action="{{ route('admin.users.toggle-active', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="{{ $user->email_verified_at ? 'text-yellow-600' : 'text-green-600' }} font-bold hover:underline text-xs">
                                        {{ $user->email_verified_at ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
