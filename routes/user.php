<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\userAuthMiddleware;
use App\Http\Controllers\fetchController;
use App\Http\Controllers\user\realTimeController;
use App\Http\Controllers\authanticationController;
use routes\web;

Route::group(['prefix'=>'user','as'=>'user.','middleware'=>userAuthMiddleware::class],function(){
    route::get('realTime',[realTimeController::class,'realTime'])->name('realTime');
});