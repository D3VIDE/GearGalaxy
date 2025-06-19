<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsRegularUser;
use Illuminate\Support\Facades\Route;



// ! Ini Untuk Guest
Route::middleware('guest')->group(function () {
    Route::get('auth/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('auth/login', [UserController::class, 'login'])->name('login.post');
    Route::get('auth/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('auth/register', [UserController::class, 'create'])->name('register.post');
    Route::get('HomePage',[UserController::class,'DisplayHomePage'])->name('HomePage');
    Route::get('/', function () {
    return view('HomePage');
});
});
    Route::post('auth/logout',[UserController::class, 'logout'])->name('logout');
// ! Ini Untuk Admin
Route::middleware(['auth', EnsureIsAdmin::class])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

// ! Ini Untuk User
// Route::middleware(['auth', EnsureIsRegularUser::class])->group(function(){
//     Route::get('',[UserController::class,'']);

// });

