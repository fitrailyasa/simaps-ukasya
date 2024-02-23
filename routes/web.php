<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Juri;
use App\Http\Middleware\Dewan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTGRController;
use App\Http\Controllers\Admin\AdminTandingController;
use App\Http\Controllers\Admin\AdminPengundianController;
use App\Http\Controllers\Admin\AdminBaganController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminTimbangUlangController;
use App\Http\Controllers\Admin\AdminKontrolController;  
use App\Http\Controllers\Admin\AdminMedaliController;  
use App\Http\Controllers\Admin\AdminPengaturanController;  

Route::get('/', [HomeController::class, 'index'])->name('beranda');

Auth::routes();

Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

  // CMS Operator
  Route::middleware([Admin::class])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User
    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
    Route::post('/user', [AdminUserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}/update', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}/destroy', [AdminUserController::class, 'destroy'])->name('user.destroy');
    
    // TGR
    Route::get('/tgr', [AdminTGRController::class, 'index'])->name('tgr.index');
    Route::post('/tgr', [AdminTGRController::class, 'store'])->name('tgr.store');
    Route::put('/tgr/{id}/update', [AdminTGRController::class, 'update'])->name('tgr.update');
    Route::delete('/tgr/{id}/destroy', [AdminTGRController::class, 'destroy'])->name('tgr.destroy');
    Route::post('/tgr/upload', [AdminTGRController::class, 'import'])->name('tgr.import');
    Route::delete('/tgr/destroy-all', [AdminTGRController::class, 'destroyAll'])->name('tgr.destroy-all');

    // Tanding
    Route::get('/tanding', [AdminTandingController::class, 'index'])->name('tanding.index');
    Route::post('/tanding', [AdminTandingController::class, 'store'])->name('tanding.store');
    Route::put('/tanding/{id}/update', [AdminTandingController::class, 'update'])->name('tanding.update');
    Route::delete('/tanding/{id}/destroy', [AdminTandingController::class, 'destroy'])->name('tanding.destroy');
    Route::post('/tanding/upload', [AdminTandingController::class, 'import'])->name('tanding.import');
    Route::delete('/tanding/destroy-all', [AdminTandingController::class, 'destroyAll'])->name('tanding.destroy-all');

    // Pengundian
    Route::get('/pengundian', [AdminPengundianController::class, 'index'])->name('pengundian.index');
    Route::post('/pengundian', [AdminPengundianController::class, 'store'])->name('pengundian.store');
    Route::put('/pengundian/{id}/update', [AdminPengundianController::class, 'update'])->name('pengundian.update');
    Route::delete('/pengundian/{id}/destroy', [AdminPengundianController::class, 'destroy'])->name('pengundian.destroy');
    
    // Bagan
    Route::get('/bagan', [AdminBaganController::class, 'index'])->name('bagan.index');
    Route::post('/bagan', [AdminBaganController::class, 'store'])->name('bagan.store');
    Route::put('/bagan/{id}/update', [AdminBaganController::class, 'update'])->name('bagan.update');
    Route::delete('/bagan/{id}/destroy', [AdminBaganController::class, 'destroy'])->name('bagan.destroy');
    
    // Jadwal
    Route::get('/jadwal', [AdminJadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal', [AdminJadwalController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/{id}/update', [AdminJadwalController::class, 'update'])->name('jadwal.update'); 
    Route::delete('/jadwal/{id}/destroy', [AdminJadwalController::class, 'destroy'])->name('jadwal.destroy');

    // Timbang Ulang
    Route::get('/timbang-ulang', [AdminTimbangUlangController::class, 'index'])->name('timbang-ulang.index');
    Route::post('/timbang-ulang', [AdminTimbangUlangController::class, 'store'])->name('timbang-ulang.store');
    Route::put('/timbang-ulang/{id}/update', [AdminTimbangUlangController::class, 'update'])->name('timbang-ulang.update');
    Route::delete('/timbang-ulang/{id}/destroy', [AdminTimbangUlangController::class, 'destroy'])->name('timbang-ulang.destroy');
    
    // Kontrol
    Route::get('/kontrol', [AdminKontrolController::class, 'index'])->name('kontrol.index');
    
    // Perolehan Medali
    Route::get('/medali', [AdminMedaliController::class, 'index'])->name('medali.index');
    
    // Pengaturan
    Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');

  });

  // CMS Juri
  Route::middleware([Juri::class])->name('juri.')->prefix('juri')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  });

  // CMS Dewan
  Route::middleware([Dewan::class])->name('dewan.')->prefix('dewan')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  });

});
