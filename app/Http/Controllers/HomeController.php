<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $categories = Category::withCount('products')->get();

        $testimonials = [
            ['name' => 'Alvina R.', 'text' => 'Keychainnya super lucu! Kualitasnya bagus banget dan packagingnya cute 🌸', 'rating' => 5],
            ['name' => 'Bunga S.', 'text' => 'Pesan custom bracelet buat hadiah ulang tahun, hasilnya melebihi ekspektasi! ✨', 'rating' => 5],
            ['name' => 'Citra M.', 'text' => 'Bag charm Wigglepop selalu jadi bahan compliment teman-teman 💕', 'rating' => 5],
            ['name' => 'Dinda F.', 'text' => 'Phone strap-nya kuat dan colorful banget, cocok buat daily use!', 'rating' => 5],
        ];

        return view('home.index', compact('featuredProducts', 'categories', 'testimonials'));
    }
}
