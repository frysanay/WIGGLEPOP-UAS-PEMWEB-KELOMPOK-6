<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiWishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Auth routes
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login', [ApiAuthController::class, 'login']);

    // Public catalog routes
    Route::get('/products', [ApiProductController::class, 'index']);
    Route::get('/products/{slug}', [ApiProductController::class, 'show']);
    Route::get('/categories', [ApiCategoryController::class, 'index']);

    // Protected routes (requires Sanctum token)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [ApiAuthController::class, 'logout']);

        // Wishlist
        Route::get('/wishlist', [ApiWishlistController::class, 'index']);
        Route::post('/wishlist/{productId}', [ApiWishlistController::class, 'toggle']);

        // Orders
        Route::get('/orders', [ApiOrderController::class, 'index']);
        Route::get('/orders/{id}', [ApiOrderController::class, 'show']);
        Route::post('/orders', [ApiOrderController::class, 'store']);
    });
});
