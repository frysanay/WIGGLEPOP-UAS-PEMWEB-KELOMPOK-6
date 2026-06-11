<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use Illuminate\Http\Request;

class AdminCustomOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomOrder::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $customOrders = $query->paginate(15)->withQueryString();
        return view('admin.custom-orders.index', compact('customOrders'));
    }

    public function show(CustomOrder $customOrder)
    {
        $customOrder->load('user');
        return view('admin.custom-orders.show', compact('customOrder'));
    }

    public function update(Request $request, CustomOrder $customOrder)
    {
        $validated = $request->validate([
            'status'      => ['required', 'in:pending,awaiting_payment,process,done,cancelled'],
            'admin_note'  => ['nullable', 'string'],
            'final_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $customOrder->update($validated);

        return back()->with('success', 'Custom order berhasil diperbarui!');
    }

    public function edit(CustomOrder $customOrder)
    {
        return view('admin.custom-orders.edit', compact('customOrder'));
    }

    public function destroy(CustomOrder $customOrder)
    {
        $customOrder->delete();
        return redirect()->route('admin.custom-orders.index')->with('success', 'Custom order dihapus.');
    }

    public function create() { return redirect()->route('admin.custom-orders.index'); }
    public function store(Request $request) { return redirect()->route('admin.custom-orders.index'); }
}
