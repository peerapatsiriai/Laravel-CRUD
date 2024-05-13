<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('productspages');
    Route::get('/createproduct', [ProductController::class, 'createpage'])->name('createpage');
    // Route::get('/editproduct', [ProductController::class, 'editpage'])->name('editpage');
});

// handler auth
Route::post('/login', [AuthController::class, 'login'])->name('login.check');
Route::post('/register', [AuthController::class, 'register'])->name('register.member');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// handler product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products', [ProductController::class, 'create'])->name('product.create');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::fallback(function () {
    return redirect()->route('productspages');
});
