<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsRegularUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;



Route::get('/', [UserController::class, 'DisplayHomePage'])->name('HomePage');
Route::post('auth/logout', [UserController::class, 'logout'])->name('logout');
// Cart routes
Route::get('/cart', function () {
    return view('user.cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('user.checkout');
})->name('checkout');
Route::get('/confirmation', function () {
    return view('user.confirmation');
})->name('confirmation');

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
Route::middleware(['auth', EnsureIsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminPagesController::class, 'index'])->name('dashboard');
    // Product
    Route::get('/admin/products/Produk', [AdminPagesController::class, 'showAddProdukForm'])->name('addProduk');
    Route::post('/admin/products/Produk', [AdminPagesController::class, 'addProduk'])->name('addProduk.post');
    Route::get('/admin/products/list', [AdminPagesController::class, 'displayListProduct'])->name('ListProduk');
    Route::get('/admin/products/edit-product/{id}', [AdminPagesController::class, 'edit_product'])->name('editProduk');
    Route::put('/admin/products/update/{id}', [AdminPagesController::class, 'update_product'])->name('updateProduk');
    Route::delete('/admin/products/delete/{id}', [AdminPagesController::class, 'destroy_product'])->name('deleteProduk');
    // Category
    Route::get('/admin/products/Category', [AdminPagesController::class, 'displayCategoryForm'])->name('category');
    Route::post('/admin/products/Category', [AdminPagesController::class, 'addCategory'])->name('addCategory.post');
    Route::get('/admin/categories/list', [AdminPagesController::class, 'displayListCategory'])->name('ListCategory');
    Route::get('/admin/categories/edit/{id}', [AdminPagesController::class, 'editCategory'])->name('editCategory');
    Route::put('/admin/categories/update/{id}', [AdminPagesController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('/admin/categories/delete/{id}', [AdminPagesController::class, 'deleteCategory'])->name('deleteCategory');
    // Variant
    Route::get('/admin/products/variant', [AdminPagesController::class, 'showAddVariantForm'])->name('addVariant');
    Route::post('/admin/products/variant', [AdminPagesController::class, 'addVariant'])->name('addVariant.post');
    Route::get('/admin/variants/list', [AdminPagesController::class, 'displayListVariant'])->name('ListVariant');
    Route::get('/admin/variants/edit/{id}', [AdminPagesController::class, 'editVariant'])->name('editVariant');
    Route::put('/admin/variants/update/{id}', [AdminPagesController::class, 'updateVariant'])->name('updateVariant');
    Route::delete('/admin/variants/delete/{id}', [AdminPagesController::class, 'deleteVariant'])->name('deleteVariant');
    // Variant Attribute
    Route::get('/admin/products/variant-attribute', [AdminPagesController::class, 'showAddVariantAttributeForm'])->name('addVariantAttribute');
    Route::post('/admin/products/variant-attribute', [AdminPagesController::class, 'addVariantAttribute'])->name('addVariantAttribute.post');
    Route::get('/admin/variant-attribute/list', [AdminPagesController::class, 'displayListVariantAttribute'])->name('listVariantAttribute');
    Route::get('/admin/variant-attributes/edit/{id}', [AdminPagesController::class, 'editVariantAttribute'])->name('editVariantAttribute');
    Route::put('/admin/variant-attributes/update/{id}', [AdminPagesController::class, 'updateVariantAttribute'])->name('updateVariantAttribute');
    Route::delete('/admin/variant-attributes/delete/{id}', [AdminPagesController::class, 'deleteVariantAttribute'])->name('deleteVariantAttribute');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/account', function () {
        return view('profile.account', ['user' => Auth::user()]);
    })->name('account');

    Route::post('/account/update-username', [AccountController::class, 'updateUsername'])->name('account.update.username');
    Route::post('/account/update-email', [AccountController::class, 'updateEmail'])->name('account.update.email');
    Route::post('/account/delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
});

// ! Ini Untuk User
// Route::middleware(['auth', EnsureIsRegularUser::class])->group(function(){
//     Route::get('',[UserController::class,'']);

// });
