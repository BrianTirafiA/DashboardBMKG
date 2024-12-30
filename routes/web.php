<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('basic');
});
Route::view('/template', 'basic');
