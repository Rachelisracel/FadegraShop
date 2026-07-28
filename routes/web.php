<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;


// ==========================================
// 1. CÁC TRANG CƠ BẢN
// ==========================================
Route::get('/', function () { return view('clients.pages.home'); })->name('home');
Route::get('/menu', function () { return view('clients.pages.menu'); })->name('menu');
Route::get('/search', function () { return view('clients.pages.search'); })->name('search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==========================================
// 2. GIỎ HÀNG & THANH TOÁN
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/cart', function () { return view('clients.pages.cart'); })->name('cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.post');
});
// ==========================================
// 3. XÁC THỰC (ĐĂNG NHẬP, ĐĂNG KÝ, QUÊN MẬT KHẨU)
// ==========================================
Route::get('/login', function () { return view('clients.pages.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () { return view('clients.pages.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Luồng Quên mật khẩu & OTP
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('forgot-password.post');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify-otp');
Route::post('/verify-otp', [AuthController::class, 'processVerifyOtp'])->name('verify-otp.post');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp.post');

Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'processResetPassword'])->name('reset-password.post');

// ==========================================
// 4. TRANG QUẢN TRỊ ADMIN / STAFF
// ==========================================
Route::prefix('admin')
->name('admin.')
->middleware(['auth', 'role:admin,staff'])
->group(function () {
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();
        $thisMonth = \Carbon\Carbon::now()->month;
        $thisYear = \Carbon\Carbon::now()->year;

        $dailyRevenue = \App\Models\Order::whereDate('created_at', $today)->sum('total_price');
        $monthlyRevenue = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->sum('total_price');
        
        $dailyOrders = \App\Models\Order::whereDate('created_at', $today)->count();
        $monthlyOrders = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->count();

        return view('admin.pages.dashboard', compact('dailyRevenue', 'monthlyRevenue', 'dailyOrders', 'monthlyOrders')); 
    })->name('dashboard');;

    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'show', 'edit']);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'show', 'edit']);
    });
    Route::get('/orders-test', function () {
    return view('admin.pages.orders', ['orders' => App\Models\Order::paginate(20)]);
    })->name('admin.orders.test');

});

// 5. ĐƠN HÀNG CỦA KHÁCH (CLIENT)
    Route::middleware('auth')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
});

