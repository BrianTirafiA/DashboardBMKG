<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;
use App\Http\Controllers\DropdownController;

Route::get('/', [HomeController::class, 'home']);

Route::controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware([\App\Http\Middleware\OnlyGuestMiddleware::class]);
    Route::post('/logout', 'doLogOut')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
});
Route::view('/qcdashboard', 'home')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/home', 'home')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset', 'itAsset.dashboard')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/dashboard', 'itAsset.dashboard')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/device', 'itAsset.device')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/rack', 'itAsset.rack')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/power', 'itAsset.power')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/report', 'itAsset.report')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/maintenance', 'itAsset.maintenance')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/itasset/log', 'itAsset.log')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);


Route::view('/lendasset/lendingitems', 'lending-asset.dashboard-lending')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/transaksi-pengajuan', 'lending-asset.transaksi-pengajuan')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/transaksi-peminjaman', 'lending-asset.transaksi-peminjaman')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/transaksi-pengembalian', 'lending-asset.transaksi-pengembalian')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/report-week', 'lending-asset.report-week')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/report-month', 'lending-asset.report-month')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/report-year', 'lending-asset.report-year')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/items', 'lending-asset.items')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/kategori', 'lending-asset.kategori')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/lokasi', 'lending-asset.lokasi')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/user', 'lending-asset.user')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);
Route::view('/lendasset/unitkerja', 'lending-asset.unitkerja')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/settings', 'lending-asset.settings')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::view('/lendasset/edit-faq', 'lending-asset.edit-faq')->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class]);

Route::get('/itasset', function () {
    return view('itAsset.dashboard');
});


//Route::get('/qcdashboard', [PinController::class, 'showMap']);
Route::get('/qcdashboard', [PinController::class, 'showMap'])->name('stations.filter');
