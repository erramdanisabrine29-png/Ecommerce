<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\OrderController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin dashboard (Administrator role only)
    Route::get('/admin', function () {
        return view('admin.index');
    })->middleware(['role:Administrator'])->name('admin.index');

    // Users resource (permission-based)
    Route::resource('users', UserController::class)->middleware(['permission:users.read']);

    // Stores resource (permission-based)
    Route::resource('stores', StoreController::class)->middleware(['permission:stores.read']);
    Route::post('/stores/{store}/regenerate-api-key', [StoreController::class, 'regenerateApiKey'])->name('stores.regenerateApiKey');
    Route::get('/stores/{store}/json', [StoreController::class, 'getJson'])->name('stores.json');

    // Store applications & Shopify
    Route::get('/stores/{store}/applications', [StoreController::class, 'applications'])->name('stores.applications');
    Route::get('/stores/{store}/applications/shopify', [StoreController::class, 'shopifyConfig'])->name('stores.shopify.config');
    Route::post('/stores/{store}/applications/shopify/generate', [StoreController::class, 'generateWebhook'])->name('stores.shopify.generate');

    // Orders Web CRUD
    Route::get('/orders', [OrderController::class, 'indexWeb'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'createWeb'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'storeWeb'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'showWeb'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'editWeb'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'updateWeb'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroyWeb'])->name('orders.destroy');

    // Orders workflow
    Route::get('/orders/status-workflow', [OrderController::class, 'statusWorkflow']);
    Route::post('/orders/{id}/change-status', [OrderController::class, 'changeStatus']);

    // Products CRUD (Merchant only)
    Route::get('/products', [ProductController::class, 'indexWeb'])->middleware('role:Merchant')->name('products.index');
    Route::get('/products/create', [ProductController::class, 'createWeb'])->middleware('role:Merchant')->name('products.create');
    Route::post('/products', [ProductController::class, 'storeWeb'])->middleware('role:Merchant')->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'editWeb'])->middleware('role:Merchant')->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'updateWeb'])->middleware('role:Merchant')->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroyWeb'])->middleware('role:Merchant')->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'showWeb'])->middleware('role:Merchant')->name('products.show');

    // API routes for products
    Route::prefix('api')->middleware('role:Merchant')->group(function () {
        Route::get('/stores/{store}/products', [ProductController::class, 'index'])->name('api.products.index');
        Route::post('/stores/{store}/products', [ProductController::class, 'store'])->name('api.products.store');
        Route::get('/stores/{store}/products/low-stock', [ProductController::class, 'getLowStockProducts'])->name('api.products.lowStock');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('api.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('api.products.destroy');
        Route::post('/products/{product}/decrement-stock', [ProductController::class, 'decrementStock'])->name('api.products.decrementStock');
        Route::post('/products/{product}/increment-stock', [ProductController::class, 'incrementStock'])->name('api.products.incrementStock');
        Route::get('/products/{product}/stats', [ProductController::class, 'getStats'])->name('api.products.stats');
        Route::post('/products/{product}/record-view', [ProductController::class, 'recordView'])->name('api.products.recordView');
    });

});

// Shopify webhook route (public token-based)
Route::post('/webhook/shopify/order/{token}/creation', function ($token) {
    $store = \App\Models\Store::where('webhook_token', $token)->first();

    if (!$store) {
        abort(404);
    }

    $data = request()->all();
    // Store order in database if needed

    return response()->json(['success' => true]);
});

// Require auth routes
require __DIR__.'/auth.php';
