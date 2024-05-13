<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentKeyController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\StoreProfileController;
use Illuminate\Support\Facades\Route;

// Home, About, Contact, Products Routes
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/showProducts', [HomeController::class, 'showProducts'])->name('products.show');
Route::get('/detailProducts/{id}', [HomeController::class, 'detail'])->name('products.detail');

// User Login, Logout, Register Routes
Route::get('login', [AuthController::class, 'loginUser'])->name('login.user');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Admin Login Routes
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('admin.login.post');
Route::post('/logout/admin', [AuthController::class, 'logoutAdmin'])->name('admin.logout');

// Admin Dashboard and Admin Specific Routes using 'auth:admin' middleware
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::post('/products/storeProcess', [ProductController::class, 'storeProcess'])->name('admin.products.storeProcess');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/products/{id}/delete', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{orderId}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update_status');
        Route::post('/order-details/{detailId}/update-status', [OrderController::class, 'updateStatus'])->name('order_details.updateStatus');
        Route::get('/paymentsetting', [AdminController::class, 'settingPayment'])->name('admin.payment.index');
        Route::post('/save-payment-keys', [PaymentKeyController::class, 'store'])->name('admin.savePaymentKeys');
        Route::get('/assets', [AssetController::class, 'index'])->name('admin.assets.index');
        Route::post('/assets', [AssetController::class, 'store'])->name('admin.assets.store');
        Route::get('/assets/{id}/edit', [AssetController::class, 'edit'])->name('admin.assets.edit');
        Route::put('/assets/{id}', [AssetController::class, 'update'])->name('admin.assets.update');
        Route::delete('/assets/{id}', [AssetController::class, 'destroy'])->name('admin.assets.destroy');
        Route::get('/storeProfile', [StoreProfileController::class, 'index'])->name('admin.profile.index');
        Route::post('/store/insert', [StoreProfileController::class, 'insert'])->name('admin.store.insert');
        Route::get('/store/edit', [StoreProfileController::class, 'edit'])->name('admin.store.edit');
        Route::post('/store/update', [StoreProfileController::class, 'update'])->name('admin.store.update');
    });
});

// General User Routes that need authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('pages.profile');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.cart');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/{orderId}', [OrderController::class, 'showOrder'])->name('orders.show');
});

