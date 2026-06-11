@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm flex items-center gap-4 transition">
            <div class="p-4 bg-green-50 dark:bg-green-950/20 text-green-500 rounded-2xl">
                <i data-lucide="dollar-sign" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400">Total Pendapatan</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm flex items-center gap-4 transition">
            <div class="p-4 bg-blue-50 dark:bg-blue-950/20 text-brand-blue rounded-2xl">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400">Total Pesanan</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_orders'] }} <span class="text-xs text-yellow-500 font-semibold">({{ $stats['pending_orders'] }} Pending)</span></span>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm flex items-center gap-4 transition">
            <div class="p-4 bg-purple-50 dark:bg-purple-950/20 text-brand-purple rounded-2xl">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400">Total Produk</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_products'] }} Item</span>
            </div>
        </div>

        <!-- Custom Orders Card -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm flex items-center gap-4 transition">
            <div class="p-4 bg-pink-50 dark:bg-pink-950/20 text-brand-pink rounded-2xl">
                <i data-lucide="sparkles" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400">Custom Order Pending</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['custom_orders'] }} Pengajuan</span>
            </div>
        </div>
    </div>

    <!-- Charts & Actions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart (Col span 2) -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm transition lg:col-span-2">
            <h2 class="font-heading font-bold text-gray-950 dark:text-white text-base mb-4">Grafik Transaksi & Pendapatan (7 Hari Terakhir)</h2>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Quick Notifications -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 border border-gray-300/20 dark:border-gray-800 shadow-sm transition space-y-4">
            <h2 class="font-heading font-bold text-gray-950 dark:text-white text-base">Notifikasi Panel</h2>
            <div class="space-y-3">
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center justify-between p-3 rounded-2xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-xl"><i data-lucide="mail" class="w-4 h-4"></i></div>
                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Pesan Baru</span>
                    </div>
                    <span class="px-2 py-0.5 bg-yellow-500 text-white rounded-full text-xs font-bold">{{ $stats['unread_contacts'] }}</span>
                </a>

                <a href="{{ route('admin.custom-orders.index') }}" class="flex items-center justify-between p-3 rounded-2xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400 rounded-xl"><i data-lucide="sparkles" class="w-4 h-4"></i></div>
                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Custom Order</span>
                    </div>
                    <span class="px-2 py-0.5 bg-pink-500 text-white rounded-full text-xs font-bold">{{ $stats['custom_orders'] }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Orders List -->
    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-300/20 dark:border-gray-800 shadow-sm overflow-hidden transition">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <h2 class="font-heading font-bold text-gray-950 dark:text-white text-base">Transaksi Terbaru</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-brand-purple dark:text-brand-pink hover:underline">Lihat Semua</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">No. Order</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @foreach($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-bold">#WP-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->status === 'pending')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-800 border border-yellow-300">Pending</span>
                                @elseif($order->status === 'confirmed')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-800 border border-blue-300">Diproses</span>
                                @elseif($order->status === 'shipped')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-purple-50 text-brand-purple border border-brand-pink/30">Dikirim</span>
                                @elseif($order->status === 'delivered')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-800 border border-green-300">Selesai</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-800 border border-red-300">Batal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-brand-purple dark:text-brand-pink font-semibold hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const chartData = @json($chartData);
        
        const labels = chartData.map(item => item.date);
        const orderCounts = chartData.map(item => item.count);
        const revenues = chartData.map(item => item.revenue);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pendapatan (Rp)',
                        data: revenues,
                        borderColor: '#ab9dff',
                        backgroundColor: 'rgba(171, 157, 255, 0.15)',
                        borderWidth: 2,
                        tension: 0.3,
                        yAxisID: 'y1',
                        fill: true
                    },
                    {
                        label: 'Jumlah Transaksi',
                        data: orderCounts,
                        borderColor: '#ffb2e7',
                        backgroundColor: 'rgba(255, 178, 231, 0.15)',
                        borderWidth: 2,
                        tension: 0.3,
                        yAxisID: 'y2',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    y2: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
