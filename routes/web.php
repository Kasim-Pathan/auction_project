<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authanticationController;
use App\Http\Middleware\adminAuthMiddleware;
use App\Http\Controllers\fetchController;


Route::view('/login','user.sign-in')->name('loginView');
Route::post('/login', [authanticationController::class, 'login'])->name('login');
Route::get('/logout', [authanticationController::class, 'logout'])->name('logout');
Route::get('/', [fetchController::class, 'fetchCategory'])->name('user.dashboard');

route::get('/product_detail/{id}',[fetchController::class,'product_detail'])->name('product_detail');
route::get('/category_all/{id}',[fetchController::class,'category_all'])->name('category_all');


route::view('/signup','user.sign-up')->name('signupView');
// Route::get('/signup', [authanticationController::class, 'registration'])->name('register');

require __DIR__.'\admin.php';
require __DIR__.'\user.php';
route::view('/kasim','user.main');
