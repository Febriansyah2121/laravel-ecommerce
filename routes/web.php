<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route auth Breeze
require __DIR__.'/auth.php';

// ============================================
// ROUTE YANG BISA DIAKSES SETELAH LOGIN
// ============================================
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');
    
    // Halaman Website
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
    Route::get('/promo', [PageController::class, 'promo'])->name('promo');
    
    // ROUTE PRODUK (PUBLIK)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    
    // ROUTE CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    // ROUTE CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    
    // ROUTE PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ============================================
    // ROUTE ADMIN (Khusus role admin)
    // ============================================
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // ============================================
        // DASHBOARD - MENGGUNAKAN DASHBOARDCONTROLLER
        // ============================================
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // ============================================
        // ROUTE KATEGORI (CRUD)
        // ============================================
        Route::resource('categories', AdminCategoryController::class);
        
        // ============================================
        // ROUTE PRODUK (CRUD)
        // ============================================
        Route::resource('products', AdminProductController::class);
        
        // ============================================
        // ROUTE ORDERS (MANAGEMENT)
        // ============================================
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
    });
});