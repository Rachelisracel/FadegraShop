<?php

use Illuminate\Support\Facades\Route;


// trang home
Route::get('/', function () {
    return view('clients.pages.home');
});

// trang menu
Route::get('/menu', function () {
    return view('clients.pages.menu');
})->name('menu');

// trang gio hang
Route::get('/cart', function () {
    return view('clients.pages.cart'); 
})->name('cart');



//trang thanh toan
Route::get('/checkout', function () {
    return view('clients.pages.checkout');
})->name('checkout');

// Trang dang nhap
Route::get('/login', function () {
    return view('clients.pages.login');
})->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Trang dang ky
Route::get('/register', function () {
    return view('clients.pages.register');
})->name('register');

// Trang quen mat khau
Route::get('/forgot-password', function () {
    return view('clients.pages.forgot-password');
})->name('forgot-password');


//trang admin 
// Route cho phần Admin
Route::prefix('admin')->group(function () {
    
    // Quản lý người dùng
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'show', 'edit']);

    // Quản lý sản phẩm
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'show', 'edit']);

    // Quản lý đơn hàng
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    ////trang dashbroad
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();
        $thisMonth = \Carbon\Carbon::now()->month;
        $thisYear = \Carbon\Carbon::now()->year;

        $dailyRevenue = \App\Models\Order::whereDate('created_at', $today)->sum('total_price');
        $monthlyRevenue = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->sum('total_price');
        
        $dailyOrders = \App\Models\Order::whereDate('created_at', $today)->count();
        $monthlyOrders = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->count();

        return view('admin.pages.dashboard', compact('dailyRevenue', 'monthlyRevenue', 'dailyOrders', 'monthlyOrders')); 
    });
    // Sau này bạn có thể thêm các route khác của admin ở đây
    // Route::get('/dashboard', ...);
    // Route::get('/orders', ...);
});