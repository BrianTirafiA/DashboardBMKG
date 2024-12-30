<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::controller(App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/login', 'doLogin');
    Route::post('/login', 'doLogOut');
});
// Route::view('/login', 'login');
