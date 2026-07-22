<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('clients.pages.home');
});


Route::get('/menu', function () {
    return view('clients.pages.menu');
})->name('menu');