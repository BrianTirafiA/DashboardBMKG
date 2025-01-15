<?php    
    
use App\Http\Controllers\HomeController;    
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;    
use App\Http\Controllers\PertanyaanController;
use Illuminate\Support\Facades\Route;    
use App\Http\Controllers\PinController; 
use App\Http\Controllers\StationFlagController;     
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
        Route::view('/lendingitems', 'lending-asset.admin.dashboard-lending');    
        Route::view('/transaksi-pengajuan', 'lending-asset.admin.transaksi-pengajuan');    
        Route::view('/transaksi-peminjaman', 'lending-asset.admin.transaksi-peminjaman');    
        Route::view('/transaksi-pengembalian', 'lending-asset.admin.transaksi-pengembalian');    
        Route::view('/report-week', 'lending-asset.admin.report-week');    
        Route::view('/report-month', 'lending-asset.admin.report-month');    
        Route::view('/report-year', 'lending-asset.admin.report-year');    
        Route::view('/items', 'lending-asset.admin.items');    
        Route::view('/kategori', 'lending-asset.admin.kategori');    
        Route::view('/lokasi', 'lending-asset.admin.lokasi');    
        Route::view('/user', 'lending-asset.admin.user');    
        Route::get('/unitkerja', [UnitKerjaController::class, 'adminindex'])->name('unitkerja.index');    
        Route::view('/settings', 'lending-asset.admin.settings');   
        Route::get('/edit-faq', [PertanyaanController::class, 'adminindex'])->name('faq.index');  
        Route::get('/unitkerja', [UnitKerjaController::class, 'search'])->name('unitkerja.search');
    });    
});    
    
// User Routes    
Route::prefix('user')->middleware(OnlyUserMiddleware::class)->group(function () {    
    Route::view('/dashboard', 'lending-asset.user.user-dashboard');   
    Route::get('/faq', [PertanyaanController::class, 'index'])->middleware(OnlyUserMiddleware::class);  
    Route::view('/profile', 'lending-asset.user.user-profile');   
    Route::view('/kategori', 'lending-asset.user.user-kategori');   
    Route::view('/items', 'lending-asset.user.user-items');   
    Route::view('/pengajuan', 'lending-asset.user.user-pengajuan');   
    Route::view('/peminjaman', 'lending-asset.user.user-peminjaman');   
    Route::view('/pengembalian', 'lending-asset.user.user-pengembalian');  

});    
  
Route::get('/register', [UserController::class, 'showRegisterForm'])->middleware(OnlyGuestMiddleware::class)->name('register.form');  
Route::post('/register', [UserController::class, 'register'])->name('register');  

    
Route::get('/admin/qcdashboard', [StationFlagController::class, 'showMap'])->name('stations.filter');    

// Rute resource untuk FAQ  
Route::resource('/edit-faq', PertanyaanController::class)->middleware(OnlyAdminMiddleware::class);
// Route untuk resource unit kerja
Route::resource('/unitkerja', UnitKerjaController::class)->middleware(OnlyAdminMiddleware::class);
