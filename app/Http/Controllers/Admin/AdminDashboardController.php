<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'   => Order::count(),
            'total_products' => Product::count(),
            'total_users'    => User::where('role', 'user')->count(),
            'total_revenue'  => Order::whereIn('status', ['paid', 'shipped', 'delivered'])->sum('total_price'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'custom_orders'  => CustomOrder::where('status', 'pending')->count(),
            'unread_contacts'=> Contact::where('is_read', false)->count(),
        ];

        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Chart data: orders per day for the last 7 days
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartData[] = [
                'date'  => $date->format('d M'),
                'count' => Order::whereDate('created_at', $date)->count(),
                'revenue' => Order::whereDate('created_at', $date)
                    ->whereIn('status', ['paid', 'shipped', 'delivered'])
                    ->sum('total_price'),
            ];
        }

        return view('admin.dashboard', compact('stats', 'recentOrders', 'chartData'));
    }
}
