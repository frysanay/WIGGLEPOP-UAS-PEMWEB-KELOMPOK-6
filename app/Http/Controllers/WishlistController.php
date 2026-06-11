<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product.category')->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request, int $productId)
    {
        $existing = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Produk dihapus dari wishlist.';
            $inWishlist = false;
        } else {
            Wishlist::create([
                'user_id'    => auth()->id(),
                'product_id' => $productId,
            ]);
            $message = 'Produk ditambahkan ke wishlist! 💕';
            $inWishlist = true;
        }

        if ($request->expectsJson()) {
            return response()->json(['inWishlist' => $inWishlist, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
