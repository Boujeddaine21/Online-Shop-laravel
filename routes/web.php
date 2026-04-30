<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'components.layout');

//Route::get('/products', [ProductController::class, 'index']);

Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'registerUser']);

Route::get('/login', [SessionController::class, 'login'])->name('login');
Route::post('/login', [SessionController::class, 'loginUser']);
Route::post('/logout', [SessionController::class, 'logout']);

// Statische Seiten
Route::view('/about', 'about');
Route::view('/contact', 'contact');

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'create']);

    Route::patch('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'delete']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']);
});

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/shop', [ShopController::class, 'showCategorie']);
    Route::get('/shop/categorie/{id}', [ShopController::class, 'showProduct']);
    Route::get('/shop/categorie/{id}/products', [UserProductController::class, 'showProducts']);

    // Cart API
    Route::get('/api/cart', [CartController::class, 'index']);
    Route::post('/api/cart/add', [CartController::class, 'add']);
    Route::patch('/api/cart/update/{product}', [CartController::class, 'update']);
    Route::delete('/api/cart/remove/{product}', [CartController::class, 'remove']);
    Route::post('/api/cart/checkout', [CartController::class, 'checkout']);

    // User Bestellhistorie
    Route::get('/my-orders', [UserOrderController::class, 'index']);
});
