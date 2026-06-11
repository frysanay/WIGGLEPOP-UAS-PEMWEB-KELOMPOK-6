<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\AdminProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::create([
            'name'     => 'Admin Wigglepop',
            'email'    => 'admin@wigglepop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '081234567890',
            'address'  => 'Wigglepop Studio, Jakarta',
        ]);

        AdminProfile::create([
            'user_id'      => $admin->id,
            'bio'          => 'Handmade Accessory Store Manager',
            'social_links' => [
                'instagram' => 'https://instagram.com/wigglepop',
                'whatsapp'  => 'https://wa.me/6281234567890',
            ],
        ]);

        // 2. Create Regular User
        User::create([
            'name'     => 'User Wigglepop',
            'email'    => 'user@wigglepop.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'phone'    => '089876543210',
            'address'  => 'Jl. Lavender No. 5, Jakarta',
        ]);

        // 3. Create Categories
        $categoriesData = [
            [
                'name' => 'Bag Charm',
                'slug' => 'bagcharm',
                'description' => 'Cute & elegant charms for your bags',
                'image' => 'images/categories/bagcharm.jpg'
            ],
            [
                'name' => 'Bracelet',
                'slug' => 'bracelet',
                'description' => 'Handmade colorful beaded bracelets',
                'image' => 'images/categories/bracelet.jpg'
            ],
            [
                'name' => 'Keychain',
                'slug' => 'keychain',
                'description' => 'Adorable keychains to personalize your keys',
                'image' => 'images/categories/keychain.jpg'
            ],
            [
                'name' => 'Phone Strap',
                'slug' => 'phonestrap',
                'description' => 'Cute and trendy phone straps',
                'image' => 'images/categories/phonestrap.jpg'
            ],
            [
                'name' => 'Custom Order',
                'slug' => 'custom',
                'description' => 'Design your own custom accessories',
                'image' => 'images/categories/custom.jpg'
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::create($cat);
        }

        // 4. Create 10 Products mapped to the categories
        $productsData = [
            [
                'category_slug' => 'phonestrap',
                'name'          => 'Daisy Chain Strap',
                'description'   => 'Strap handphone manis dengan dekorasi manik-manik bunga daisy pastel.',
                'price'         => 30000.00,
                'stock'         => 50,
                'weight'        => 20,
                'images'        => ['images/phonestrap/daisy-chain.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'phonestrap',
                'name'          => 'Stars Night Strap',
                'description'   => 'Tampil bersinar dengan strap handphone bertema malam berbintang biru tua dan perak.',
                'price'         => 32000.00,
                'stock'         => 50,
                'weight'        => 20,
                'images'        => ['images/phonestrap/stars-night.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'phonestrap',
                'name'          => 'Rainbow Dream Strap',
                'description'   => 'Strap warna-warni pelangi yang ceria dan penuh energi positif.',
                'price'         => 33000.00,
                'stock'         => 50,
                'weight'        => 20,
                'images'        => ['images/phonestrap/rainbow-dream.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'keychain',
                'name'          => 'Flower Keychain',
                'description'   => 'Gantungan kunci bunga rajut buatan tangan yang imut dan bertekstur lembut.',
                'price'         => 25000.00,
                'stock'         => 50,
                'weight'        => 15,
                'images'        => ['images/keychain/flower.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'keychain',
                'name'          => 'Rainbow Keychain',
                'description'   => 'Gantungan kunci pelangi berbahan rajut untuk mempercantik tas atau kunci Anda.',
                'price'         => 28000.00,
                'stock'         => 50,
                'weight'        => 15,
                'images'        => ['images/keychain/rainbow.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'bracelet',
                'name'          => 'Pastel Dream Bracelet',
                'description'   => 'Gelang manik-manik dengan susunan warna pastel lembut yang estetik.',
                'price'         => 35000.00,
                'stock'         => 50,
                'weight'        => 10,
                'images'        => ['images/bracelet/pastel-dream.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'bracelet',
                'name'          => 'Butterfly Charm Bracelet',
                'description'   => 'Gelang manis dengan liontin kupu-kupu akrilik transparan yang elegan.',
                'price'         => 38000.00,
                'stock'         => 50,
                'weight'        => 10,
                'images'        => ['images/bracelet/butterfly-charm.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'bagcharm',
                'name'          => 'Rainbow Bag Charm',
                'description'   => 'Gantungan tas pelangi yang berukuran lebih besar, sangat cocok untuk backpack atau totebag.',
                'price'         => 40000.00,
                'stock'         => 50,
                'weight'        => 30,
                'images'        => ['images/bagcharm/rainbow.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'bagcharm',
                'name'          => 'Flower Bag Charm',
                'description'   => 'Gantungan tas bermotif bunga rajutan manis untuk mempercantik tas favorit Anda.',
                'price'         => 38000.00,
                'stock'         => 50,
                'weight'        => 30,
                'images'        => ['images/bagcharm/flower.jpg'],
                'is_active'     => true,
            ],
            [
                'category_slug' => 'custom',
                'name'          => 'Custom Design',
                'description'   => 'Pesan aksesori impianmu di sini! Tentukan warna, jenis manik-manik, dan detail pesanan sesuai keinginanmu.',
                'price'         => 15000.00,
                'stock'         => 999,
                'weight'        => 10,
                'images'        => ['images/custom/customdesign.jpg'],
                'is_active'     => true,
            ],
        ];

        foreach ($productsData as $prod) {
            $catSlug = $prod['category_slug'];
            unset($prod['category_slug']);
            $prod['category_id'] = $categories[$catSlug]->id;
            Product::create($prod);
        }
    }
}
