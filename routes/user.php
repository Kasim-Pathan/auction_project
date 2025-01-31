<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\userAuthMiddleware;
use App\Http\Controllers\fetchController;
use routes\web;

Route::group(['prefix'=>'user','as'=>'user.','middleware'=>userAuthMiddleware::class],function(){
    
});