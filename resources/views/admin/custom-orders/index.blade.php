@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Custom Orders</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Pengajuan custom design dari pelanggan</p>
        </div>
        <form method="GET" action="{{ route('admin.custom-orders.index') }}">
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="awaiting_payment" {{ request('status') == 'awaiting_payment' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Proses</option>
                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4">Budget</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($customOrders as $co)
                        <tr>
                            <td class="px-6 py-4 font-bold dark:text-white">#CO-{{ str_pad($co->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <span class="block font-semibold dark:text-white">{{ $co->user->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $co->user->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-gray-600 dark:text-gray-400 text-xs truncate" title="{{ $co->description }}">{{ $co->description }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold dark:text-white">
                                {{ $co->budget ? 'Rp ' . number_format($co->budget, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php 
                                    $smap = [
                                        'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'awaiting_payment' => 'bg-orange-50 text-orange-700 border-orange-200',
                                        'process' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'done' => 'bg-green-50 text-green-700 border-green-200',
                                        'cancelled' => 'bg-red-50 text-red-700 border-red-200'
                                    ]; 
                                    $lmap = [
                                        'pending' => 'Pending',
                                        'awaiting_payment' => 'Menunggu Pembayaran',
                                        'process' => 'Proses',
                                        'done' => 'Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $smap[$co->status] ?? 'bg-gray-50 text-gray-700' }}">{{ $lmap[$co->status] ?? ucfirst($co->status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xs">{{ $co->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.custom-orders.show', $co->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($customOrders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $customOrders->links() }}</div>
        @endif
    </div>
</div>
@endsection
