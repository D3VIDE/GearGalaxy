<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsRegularUser;
use Illuminate\Support\Facades\Route;




Route::get('/', [UserController::class, 'DisplayHomePage'])->name('HomePage');
Route::post('auth/logout',[UserController::class, 'logout'])->name('logout');
// Cart routes
Route::get('/cart', function() {return view('user.cart');})->name('cart');
Route::get('/checkout', function() {return view('user.checkout');})->name('checkout');
Route::get('/confirmation', function() {return view('user.confirmation');})->name('confirmation');

// Route Guest (login/register)
Route::middleware('guest')->group(function () {
    Route::get('auth/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('auth/login', [UserController::class, 'login'])->name('login.post');
    Route::get('auth/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('auth/register', [UserController::class, 'create'])->name('register.post');
    Route::get('auth/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot.password');
    Route::post('auth/forgot-password', [UserController::class, 'resetPassword'])->name('forgot.password.post');
});

// ! Ini Untuk Admin
Route::middleware(['auth', EnsureIsAdmin::class])->group(function(){
    Route::get('/admin/dashboard', [AdminPagesController::class, 'index'])->name('dashboard');
    Route::get('/admin/products/Produk',[AdminPagesController::class,'showAddProdukForm'])->name('addProduk');
    Route::post('/admin/products/Produk',[AdminPagesController::class,'addProduk'])->name('addProduk.post');
});

// ! Ini Untuk User
// Route::middleware(['auth', EnsureIsRegularUser::class])->group(function(){
//     Route::get('',[UserController::class,'']);

// });

