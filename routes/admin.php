<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\adminAuthMiddleware;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\productController;


// use routes\web;

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>adminAuthMiddleware::class],function(){
    Route::view('dashboard','adminLTE.admin')->name('dashboard');
    route::resource('category',categoryController::class);
    route::resource('product',productController::class);
    
});
