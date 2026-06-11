<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ApiWishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product.category')->get();

        return response()->json([
            'success' => true,
            'data'    => $wishlists,
        ]);
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

        return response()->json([
            'success'    => true,
            'inWishlist' => $inWishlist,
            'message'    => $message,
        ]);
    }
}
