<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;

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

    // Admin dashboard (Administrator role only)
    Route::get('/admin', function () {
        return view('admin.index');
    })->middleware(['role:Administrator'])->name('admin.index');

    // Users resource (permission-based: users.read minimum)
    Route::resource('users', UserController::class)->middleware(['permission:users.read']);
});

require __DIR__.'/auth.php';

// Stores management (permission: stores.read)
Route::middleware(['auth', 'permission:stores.read'])->group(function () {
    Route::resource('stores', StoreController::class);
    Route::post('/stores/{store}/regenerate-api-key', [StoreController::class, 'regenerateApiKey'])
        ->name('stores.regenerateApiKey');
    Route::get('/stores/{store}/json', [StoreController::class, 'getJson'])
        ->name('stores.json');
});

