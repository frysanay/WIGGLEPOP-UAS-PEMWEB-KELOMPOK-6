<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,paid,shipped,delivered,cancelled'],
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan dihapus.');
    }

    public function edit(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.edit', compact('order'));
    }

    public function create()
    {
        return redirect()->route('admin.orders.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.orders.index');
    }
}
