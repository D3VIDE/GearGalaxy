<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsRegularUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

// Route::get('/shop', function () {
//     return view('shop');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ! Ini Untuk Guest
Route::middleware('guest')->group(function () {
    Route::get('auth/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('auth/login', [UserController::class, 'login'])->name('login.post');
    Route::get('auth/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('auth/register', [UserController::class, 'create'])->name('register.post');
    
});
    Route::post('auth/logout',[UserController::class, 'logout'])->name('logout');
// ! Ini Untuk Admin
Route::middleware(['auth', EnsureIsAdmin::class])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

// ! Ini Untuk User
Route::middleware(['auth', EnsureIsRegularUser::class])->group(function(){
    Route::get('/user/MainUi',[UserController::class,'index']);

});

//require __DIR__.'/auth.php';
