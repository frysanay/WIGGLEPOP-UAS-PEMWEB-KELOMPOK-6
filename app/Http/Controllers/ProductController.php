<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc'  => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                'newest'     => $query->orderBy('created_at', 'desc'),
                default      => $query->orderBy('created_at', 'desc'),
            };
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('catalog.index', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product  = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related  = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        $inWishlist = false;
        if (auth()->check()) {
            $inWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
        }

        return view('products.show', compact('product', 'related', 'inWishlist'));
    }
}
