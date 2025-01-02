<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/logout', 'doLogOut')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
});
Route::view('/home', 'home')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
