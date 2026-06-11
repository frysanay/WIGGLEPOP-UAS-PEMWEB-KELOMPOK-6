<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $orders,
        ]);
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->with('orderItems.product')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $order,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address' => ['required', 'string'],
            'items'            => ['required', 'array'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
            'payment_proof'    => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $itemsInput = $request->input('items');
        $total = 0;
        $orderItems = [];

        try {
            DB::beginTransaction();

            foreach ($itemsInput as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if (!$product || !$product->is_active) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Produk tidak aktif atau tidak ditemukan.',
                    ], 400);
                }

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok produk {$product->name} tidak mencukupi.",
                    ], 400);
                }

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;
                $orderItems[] = [
                    'product'  => $product,
                    'quantity' => $item['quantity'],
                    'price'    => $product->price,
                ];
            }

            $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

            $order = Order::create([
                'user_id'          => auth()->id(),
                'total_price'      => $total,
                'status'           => 'pending',
                'shipping_address' => $request->input('shipping_address'),
                'payment_proof'    => $paymentProofPath,
            ]);

            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                $item['product']->decrement('stock', $item['quantity']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat! 💕',
                'data'    => $order->load('orderItems.product'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
            ], 500);
        }
    }
}
