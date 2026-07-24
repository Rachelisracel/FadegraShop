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

//trang tim kiem sp
Route::get('/search', function () {
    return view('clients.pages.search');
})->name('search');


//trang admin 
// Route cho phần Admin

Route::prefix('admin')->middleware(['auth', 'role:admin,staff'])->group(function () {
    
   
    // trang chung 
    // Quản lý đơn hàng (Staff cần vào để duyệt đơn)
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    // Trang Dashboard
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


    // chi admin moi dc vo
    Route::middleware(['role:admin'])->group(function () {
        
        // Quản lý người dùng (Staff không được quyền xem/xóa tài khoản)
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'show', 'edit']);

        // Quản lý sản phẩm (Tránh việc Staff lỡ tay xóa mất sản phẩm)
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'show', 'edit']);
        
    });

});

//Khach hang chưa đăng nhập 
Route::get('/', function () { return view('clients.pages.home'); });
Route::get('/menu', function () { return view('clients.pages.menu'); });

// Khach hang đã đăng nhập
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', function () { return view('clients.pages.cart'); });
    Route::get('/checkout', function () { return view('clients.pages.checkout'); });
    // Trang profile, lịch sử đơn hàng...
});


