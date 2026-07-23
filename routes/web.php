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
        return view('admin.pages.dashboard'); 
    });
    // Sau này bạn có thể thêm các route khác của admin ở đây
    // Route::get('/dashboard', ...);
    // Route::get('/orders', ...);
});
