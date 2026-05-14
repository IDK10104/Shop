<?php
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

// Shop
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'catalog'])->name('shop');
Route::get('/shop/{product:slug}', [ShopController::class, 'product'])->name('product');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/item/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/item/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'createSession'])->name('checkout.create');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Account (requires login)
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderHistoryController::class, 'show'])->name('orders.show');
});

// Admin (only accessible when logged in as admin email)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn() => redirect()->route('admin.products.index'));
    Route::resource('products', ProductController::class)->except('show');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});
