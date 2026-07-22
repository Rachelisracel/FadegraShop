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