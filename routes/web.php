<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'components.layout');

//Route::get('/products', [ProductController::class, 'index']);

Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'registerUser']);

Route::get('/login', [SessionController::class, 'login'])->name('login');
Route::post('/login', [SessionController::class, 'loginUser']);
Route::post('/logout', [SessionController::class, 'logout']);

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'create']);

    Route::patch('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'delete']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index']);
});

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/shop', [ShopController::class,'showCategorie']);
    Route::get('/shop/categorie/{id}', [ShopController::class,'showProduct']);
    Route::get('/shop/categorie/{id}/products', [UserProductController::class,'showProducts']);
});
