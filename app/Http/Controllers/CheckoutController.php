<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get cart from session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('catalog')->with('error', 'Keranjang belanja kamu kosong.');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'product'  => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => ['required', 'string'],
            'payment_proof'    => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('catalog')->with('error', 'Keranjang belanja kosong.');
        }

        $total = 0;
        $cartItems = [];

        foreach ($cart as $productId => $item) {
            $product = Product::findOrFail($productId);
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;
            $cartItems[] = ['product' => $product, 'quantity' => $item['quantity'], 'price' => $product->price];
        }

        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        DB::transaction(function () use ($validated, $total, $cartItems, $paymentProofPath) {
            $order = Order::create([
                'user_id'          => auth()->id(),
                'total_price'      => $total,
                'status'           => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'payment_proof'    => $paymentProofPath,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                // Decrease stock
                $item['product']->decrement('stock', $item['quantity']);
            }
        });

        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat! Mohon tunggu konfirmasi dari kami. 🎊');
    }

    // Cart add handler (handles AJAX & HTML Form redirect)
    public function addToCart(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);
        
        $quantity = intval($request->input('quantity', 1));
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = ['quantity' => $quantity];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message'  => 'Produk ditambahkan ke keranjang!',
                'cartCount' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang! 💕');
    }

    public function removeFromCart(int $productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
