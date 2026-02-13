<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin dashboard
    Route::get('/admin', function () {
        return view('admin.index');
    })->middleware(['role:admin'])->name('admin.index');

    // Users resource
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';

// Merchant stores management
Route::middleware(['auth', 'role:Merchant'])->group(function () {
    Route::resource('stores', StoreController::class);
    Route::post('/stores/{store}/regenerate-api-key', [StoreController::class, 'regenerateApiKey'])
        ->name('stores.regenerateApiKey');
    Route::get('/stores/{store}/json', [StoreController::class, 'getJson'])
        ->name('stores.json');
    // Web: show products for a specific store
    Route::get('/stores/{store}/products', [App\Http\Controllers\ProductController::class, 'indexWebByStore'])
        ->name('stores.products');

    // Orders (API)
    Route::post('/api/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('api.orders.store');
    Route::post('/api/orders/{order}/status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('api.orders.updateStatus');
    Route::get('/api/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('api.orders.index');
    Route::get('/api/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('api.orders.show');

    // Orders (web CRUD)
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'indexWeb'])->name('orders.index');
    Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'createWeb'])->name('orders.create');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'storeWeb'])->name('orders.store');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'showWeb'])->name('orders.show');
    Route::get('/orders/{order}/edit', [App\Http\Controllers\OrderController::class, 'editWeb'])->name('orders.edit');
    Route::put('/orders/{order}', [App\Http\Controllers\OrderController::class, 'updateWeb'])->name('orders.update');
    Route::delete('/orders/{order}', [App\Http\Controllers\OrderController::class, 'destroyWeb'])->name('orders.destroy');
});

// Products management page
Route::get('/products', [ProductController::class, 'indexWeb'])
    ->middleware(['auth', 'role:Merchant'])
    ->name('products.index');

// Products CRUD routes
Route::middleware(['auth', 'role:Merchant'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'createWeb'])->name('products.create');
    Route::post('/products', [ProductController::class, 'storeWeb'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'editWeb'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'updateWeb'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroyWeb'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'showWeb'])->name('products.show');
});

// Product API routes
Route::middleware(['auth', 'role:Merchant'])->group(function () {
    // List products by store
    Route::get('/api/stores/{store}/products', [ProductController::class, 'index'])
        ->name('api.products.index');
    
    // Create product
    Route::post('/api/stores/{store}/products', [ProductController::class, 'store'])
        ->name('api.products.store');
    
    // Get low stock products for store
    Route::get('/api/stores/{store}/products/low-stock', [ProductController::class, 'getLowStockProducts'])
        ->name('api.products.lowStock');
    
    // Show product
    Route::get('/api/products/{product}', [ProductController::class, 'show'])
        ->name('api.products.show');
    
    // Update product
    Route::put('/api/products/{product}', [ProductController::class, 'update'])
        ->name('api.products.update');
    
    // Delete product
    Route::delete('/api/products/{product}', [ProductController::class, 'destroy'])
        ->name('api.products.destroy');
    
    // Stock management
    Route::post('/api/products/{product}/decrement-stock', [ProductController::class, 'decrementStock'])
        ->name('api.products.decrementStock');
    Route::post('/api/products/{product}/increment-stock', [ProductController::class, 'incrementStock'])
        ->name('api.products.incrementStock');
    
    // Product statistics
    Route::get('/api/products/{product}/stats', [ProductController::class, 'getStats'])
        ->name('api.products.stats');
    Route::post('/api/products/{product}/record-view', [ProductController::class, 'recordView'])
        ->name('api.products.recordView');
});

