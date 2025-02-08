<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\ItemLocationController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemStatusController;
use App\Http\Controllers\ItemBrandController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\UserControllerForUpdateData;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\UserDashboard;
use App\Http\Middleware\CheckUserOrAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;
use App\Http\Controllers\StationFlagController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Middleware\OnlyUserMiddleware;
use App\Http\Middleware\LogoutMiddleware;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TypeDeviceController;
use App\Http\Controllers\UserControllerForAdmin;


Route::get('/', [HomeController::class, 'home']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware(OnlyGuestMiddleware::class)->name('login');
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', [UserController::class, 'doLogOut'])->middleware(LogoutMiddleware::class);
});

// Admin Routes    
Route::prefix('admin')->middleware(OnlyAdminMiddleware::class)->group(function () {
    Route::view('/qcdashboard', 'home');
    Route::view('/home', 'home');
    Route::view('/dashboard', 'dashboard');

    // Route::get('/profile', [UserControllerForUpdateData::class, 'index'])->name('profileadmin.index');   

    Route::prefix('itasset')->group(function () {
        Route::view('/dashboard', 'itAsset.dashboard');
        Route::view('/device', 'itAsset.device');
        Route::view('/rack', 'itAsset.rack');
        Route::view('/power', 'itAsset.power');
        Route::view('/report', 'itAsset.report');
        Route::view('/maintenance', 'itAsset.maintenance');
        Route::view('/log', 'itAsset.log');
        Route::Resource('/device', controller: DeviceController::class);
        Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
        Route::post('/type-device/store', [TypeDeviceController::class, 'store'])->name('typeDevice.store');

    });

    Route::prefix('lendasset')->group(function () {
        Route::view('/dashboard', 'lending-asset.admin.dashboard-lending');
        Route::view('/report', LaporanController::class, );
        Route::get('/report', [LaporanController::class, 'reportindex'])->name('report.index');
        Route::get('/report/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
        Route::resource('/transaksi-pengajuan', LoanRequestController::class, );
        Route::get('/transaksi-pengajuan', [LoanRequestController::class, 'index'])->name('pengajuan.index');
        Route::resource('/transaksi-proses', LoanRequestController::class, );
        Route::get('/transaksi-proses', [LoanRequestController::class, 'onprocessindex'])->name('proses.index');
        Route::view('/transaksi-pengembalian', LoanRequestController::class, );
        Route::get('/transaksi-pengembalian', [LoanRequestController::class, 'pengembalianindex'])->name('pengembalian.index');
        Route::view('/transaksi-dibatalkan', LoanRequestController::class, );
        Route::get('/transaksi-dibatalkan', [LoanRequestController::class, 'rejectedindex'])->name('rejected.index');

        Route::resource('/items', ItemDetailController::class);
        Route::get('/items', [ItemDetailController::class, 'index'])->name('item.index');
        Route::resource('/brand', ItemBrandController::class);
        Route::get('/brand', [ItemBrandController::class, 'index'])->name('brand.index');
        Route::resource('/status', ItemStatusController::class);
        Route::get('/status', [ItemStatusController::class, 'index'])->name('status.index');
        Route::resource('/kategori', ItemCategoryController::class);
        Route::get('/kategori', [ItemCategoryController::class, 'index'])->name('kategori.index');
        Route::resource('/lokasi', ItemLocationController::class);
        Route::get('/lokasi', [ItemLocationController::class, 'locationindex'])->name('location.index');
        Route::resource('/users', UserControllerForAdmin::class);
        Route::get('/users', [UserControllerForAdmin::class, 'index'])->name('users.index');
        Route::get('/unitkerja', [UnitKerjaController::class, 'adminindex'])->name('unitkerja.index');
        Route::get('/edit-faq', [PertanyaanController::class, 'adminindex'])->name('faq.index');
        Route::get('/unitkerja', [UnitKerjaController::class, 'search'])->name('unitkerja.search');
    });
});

// User Routes    
Route::prefix('user')->middleware(OnlyUserMiddleware::class)->group(function () {
    Route::resource('/dashboard', UserDashboard::class);
    Route::get('/dashboard', [UserDashboard::class, 'itemindex'])->name('item.index');
    Route::post('/dashboard/addcart', [UserDashboard::class, 'addToCart'])->name('cart.add');
    Route::get('/dashboard/get', [UserDashboard::class, 'getCart'])->name('cart.get');
    Route::post('/dashboard/update', [UserDashboard::class, 'updateCart'])->name('cart.update');
    Route::post('/dashboard/remove', [UserDashboard::class, 'removeCart'])->name('cart.remove');
    Route::post('/dashboard/addrequest', [UserDashboard::class, 'storefromcart'])->name('storefromcart');
    Route::get('/faq', [PertanyaanController::class, 'index'])->middleware(OnlyUserMiddleware::class);
    Route::resource('/pengajuan', LoanRequestController::class, );
    Route::get('/pengajuan', [LoanRequestController::class, 'user_pengajuanindex'])->name('user_pengajuanindex');
    Route::resource('/proses', LoanRequestController::class, );
    Route::get('/proses', [LoanRequestController::class, 'user_prosesindex'])->name('user_prosesindex');
    Route::resource('/pengembalian', LoanRequestController::class, );
    Route::get('/pengembalian', [LoanRequestController::class, 'user_pengembalianindex'])->name('user_pengembalianindex');
    Route::resource('/riwayat', LoanRequestController::class, );
    Route::get('/riwayat', [LoanRequestController::class, 'user_riwayatindex'])->name('user_riwayatindex');

});

Route::get('/register', [UserController::class, 'showRegisterForm'])->middleware(OnlyGuestMiddleware::class)->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');


Route::get('/admin/qcdashboard', [StationFlagController::class, 'filter'])->name('stations.filter');

// Rute resource untuk FAQ  
Route::resource('/edit-faq', PertanyaanController::class)->middleware(OnlyAdminMiddleware::class);
// Route untuk resource unit kerja
Route::resource('/unitkerja', UnitKerjaController::class)->middleware(OnlyAdminMiddleware::class);

Route::resource('/profile', UserControllerForUpdateData::class)->middleware(CheckUserOrAdmin::class);
Route::get('/profile', [UserControllerForUpdateData::class, 'index'])->middleware(CheckUserOrAdmin::class)->name('profile.index');

// Route untuk upload dan delete gambar profil    
Route::post('/profile/{id}/upload-image', [UserControllerForUpdateData::class, 'uploadImage'])->name('profile.upload.image');
Route::delete('/profile/{id}/delete-image', [UserControllerForUpdateData::class, 'deleteImage'])->name('profile.delete.image');
Route::get('/profile-photo/{filename}', [ProfilePhotoController::class, 'show'])->name('profile.photo');
Route::post('/items/{id}/update-images', [ItemController::class, 'updateImages'])->name('items.update.images');
Route::delete('/items/{id}/delete-image/{imageNumber}', [ItemController::class, 'deleteImage'])->name('items.delete.image');

