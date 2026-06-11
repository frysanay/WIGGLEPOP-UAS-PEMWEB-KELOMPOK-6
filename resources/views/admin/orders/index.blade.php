@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">Kelola Pesanan</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat dan perbarui status semua transaksi pelanggan</p>
        </div>
        <!-- Status Filter -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2">
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm outline-none dark:text-white">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">No. Order</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900 dark:text-white">#WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <span class="block font-semibold text-gray-800 dark:text-white">{{ $order->user->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $order->user->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php $statusMap = ['pending'=>['bg-yellow-50 text-yellow-700 border-yellow-200','Pending'], 'confirmed'=>['bg-blue-50 text-blue-700 border-blue-200','Diproses'], 'shipped'=>['bg-purple-50 text-brand-purple border-brand-pink/30','Dikirim'], 'delivered'=>['bg-green-50 text-green-700 border-green-200','Selesai'], 'cancelled'=>['bg-red-50 text-red-700 border-red-200','Batal']]; $s = $statusMap[$order->status] ?? ['bg-gray-50 text-gray-700 border-gray-200', $order->status]; @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $s[0] }}">{{ $s[1] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection
