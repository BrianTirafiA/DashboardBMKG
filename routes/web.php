<?php  
  
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\UserController;  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\PinController;  
use App\Http\Middleware\OnlyGuestMiddleware;  
use App\Http\Middleware\OnlyAdminMiddleware;  
use App\Http\Middleware\OnlyUserMiddleware;  
use App\Http\Middleware\LogoutMiddleware;  

Route::get('/', [HomeController::class, 'home']);  
  
Route::controller(UserController::class)->group(function () {  
    Route::get('/login', 'login')->middleware(OnlyGuestMiddleware::class);  
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);  
    Route::post('/logout', [UserController::class, 'doLogOut'])->middleware(LogoutMiddleware::class);
});  
  
// Admin Routes  
Route::prefix('admin')->middleware(OnlyAdminMiddleware::class)->group(function () {  
    Route::view('/qcdashboard', 'home');  
    Route::view('/home', 'home');  
  
    Route::prefix('itasset')->group(function () {  
        Route::view('/dashboard', 'itAsset.dashboard');  
        Route::view('/device', 'itAsset.device');  
        Route::view('/rack', 'itAsset.rack');  
        Route::view('/power', 'itAsset.power');  
        Route::view('/report', 'itAsset.report');  
        Route::view('/maintenance', 'itAsset.maintenance');  
        Route::view('/log', 'itAsset.log');  
    });  
  
    Route::prefix('lendasset')->group(function () {  
        Route::view('/lendingitems', 'lending-asset.dashboard-lending');  
        Route::view('/transaksi-pengajuan', 'lending-asset.transaksi-pengajuan');  
        Route::view('/transaksi-peminjaman', 'lending-asset.transaksi-peminjaman');  
        Route::view('/transaksi-pengembalian', 'lending-asset.transaksi-pengembalian');  
        Route::view('/report-week', 'lending-asset.report-week');  
        Route::view('/report-month', 'lending-asset.report-month');  
        Route::view('/report-year', 'lending-asset.report-year');  
        Route::view('/items', 'lending-asset.items');  
        Route::view('/kategori', 'lending-asset.kategori');  
        Route::view('/lokasi', 'lending-asset.lokasi');  
        Route::view('/user', 'lending-asset.user');  
        Route::view('/unitkerja', 'lending-asset.unitkerja');  
        Route::view('/settings', 'lending-asset.settings');  
        Route::view('/edit-faq', 'lending-asset.edit-faq');  
    });  
});  
  
// User Routes  
Route::prefix('user')->middleware(OnlyUserMiddleware::class)->group(function () {  
    Route::view('/dashboard', 'lending-asset.user-dashboard'); // Placeholder - Replace with your actual user routes  
    // Add more user routes here...  
});  
  
Route::get('/admin/qcdashboard', [PinController::class, 'showMap'])->name('stations.filter');  
  
