<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;

Route::get('/', [HomeController::class, 'home']);

Route::controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/logout', 'doLogOut')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
});
Route::view('/qcdashboard', 'home')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::get('/itasset', function () {
    return view('itAsset.dashboard');
});

Route::get('/lendingitems', function () {
    return view('lending-asset.dashboard-lending');
});

Route::get('/user', function () {
    return view('lending-asset.user');
});

Route::get('/qcdashboard', [PinController::class, 'showMap']);
