<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authanticationController;
use App\Http\Controllers\fetchController;

Route::view('/login','user.sign-in')->name('loginView');
Route::post('/login', [authanticationController::class, 'login'])->name('login');
Route::get('/logout', [authanticationController::class, 'logout'])->name('logout');
Route::get('/', [fetchController::class, 'fetchCategory'])->name('user.dashboard');

Route::get('/product_detail/{id}',[fetchController::class,'product_detail'])->name('product_detail');
Route::get('/category_all/{id}',[fetchController::class,'category_all'])->name('category_all');

route::get('/place_bid/{id}',[fetchController::class,'place_bid'])->name('place_bid');

Route::view('/signup','user.sign-up')->name('signupView');
Route::post('/signup', [authanticationController::class, 'registration'])->name('signup');

require __DIR__.'\admin.php';
require __DIR__.'\user.php';
