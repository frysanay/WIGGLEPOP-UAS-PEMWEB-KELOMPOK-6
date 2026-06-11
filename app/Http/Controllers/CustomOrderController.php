<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    /** List all custom orders milik user yang sedang login */
    public function index()
    {
        $customOrders = CustomOrder::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('custom-order.index', compact('customOrders'));
    }

    /** Form pengajuan custom order baru */
    public function create()
    {
        return view('custom-order.create');
    }

    /** Simpan pengajuan baru */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'     => ['required', 'string', 'min:20'],
            'reference_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'budget'          => ['required', 'numeric', 'min:10000'],
        ]);

        $imagePath = null;
        if ($request->hasFile('reference_image')) {
            $imagePath = $request->file('reference_image')->store('custom-orders', 'public');
        }

        $customOrder = CustomOrder::create([
            'user_id'         => auth()->id(),
            'description'     => $validated['description'],
            'reference_image' => $imagePath,
            'budget'          => $validated['budget'],
            'final_price'     => $validated['budget'],
            'status'          => 'awaiting_payment',
        ]);

        return redirect()->route('custom-order.pay', $customOrder->id)
            ->with('success', 'Custom order berhasil diajukan! Silakan lakukan pembayaran sesuai estimasi budget kamu di bawah ini. 💌');
    }

    /** Tampilkan form upload bukti pembayaran */
    public function pay(CustomOrder $customOrder)
    {
        // Pastikan hanya pemiliknya yang bisa bayar
        abort_if($customOrder->user_id !== auth()->id(), 403);
        // Hanya bisa bayar jika status awaiting_payment
        abort_if($customOrder->status !== 'awaiting_payment', 403);

        return view('custom-order.pay', compact('customOrder'));
    }

    /** Proses upload bukti pembayaran */
    public function submitPayment(Request $request, CustomOrder $customOrder)
    {
        abort_if($customOrder->user_id !== auth()->id(), 403);
        abort_if($customOrder->status !== 'awaiting_payment', 403);

        $request->validate([
            'payment_proof' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $path = $request->file('payment_proof')->store('custom-order-payments', 'public');

        $customOrder->update([
            'payment_proof' => $path,
            'status'        => 'process',
        ]);

        return redirect()->route('custom-order.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim! Pesananmu sedang kami proses. 🎉');
    }
}
