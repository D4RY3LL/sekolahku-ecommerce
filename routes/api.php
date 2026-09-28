<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/v1/test', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working!',
        'timestamp' => now()
    ]);
});

// Product API Endpoints
Route::prefix('v1')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/best-sellers', [ProductController::class, 'bestSellers']);
    Route::get('/products/promo', [ProductController::class, 'promo']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);
    Route::get('/categories', [ProductController::class, 'categories']);
});