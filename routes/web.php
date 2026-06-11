<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomOrderController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminProfileController;

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Guest Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Cart & Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/cart/add/{productId}', [CheckoutController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{productId}', [CheckoutController::class, 'removeFromCart'])->name('cart.remove');

    // Orders
    Route::get('/orders', [OrderController::class, 'userIndex'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Custom Orders
    Route::get('/custom-order', [CustomOrderController::class, 'index'])->name('custom-order.index');
    Route::get('/custom-order/create', [CustomOrderController::class, 'create'])->name('custom-order.create');
    Route::post('/custom-order', [CustomOrderController::class, 'store'])->name('custom-order.store');
    Route::get('/custom-order/{customOrder}/pay', [CustomOrderController::class, 'pay'])->name('custom-order.pay');
    Route::post('/custom-order/{customOrder}/pay', [CustomOrderController::class, 'submitPayment'])->name('custom-order.submit-payment');

    // Profile
    Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'updateUser'])->name('profile.update');
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::post('/products/{id}/restore', [AdminProductController::class, 'restore'])->name('products.restore');
    Route::resource('/products', AdminProductController::class);

    // Categories
    Route::resource('/categories', AdminCategoryController::class);

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

    // Custom Orders
    Route::get('/custom-orders', [AdminCustomOrderController::class, 'index'])->name('custom-orders.index');
    Route::get('/custom-orders/{customOrder}', [AdminCustomOrderController::class, 'show'])->name('custom-orders.show');
    Route::put('/custom-orders/{customOrder}', [AdminCustomOrderController::class, 'update'])->name('custom-orders.update');

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/toggle-active', [AdminUserController::class, 'toggleActive'])->name('users.toggle-active');

    // Contacts
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{contact}/mark-read', [AdminContactController::class, 'markRead'])->name('contacts.mark-read');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});
