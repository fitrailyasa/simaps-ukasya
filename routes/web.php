<?php

use App\Http\Controllers\Auth\AuthController;
use App\Livewire\MenungguJadwal;
use App\Livewire\Operator\OperatorGandaKontrol;
use App\Livewire\Operator\OperatorJadwalTanding;
use App\Livewire\Operator\OperatorJadwalTGR;
use App\Livewire\Operator\OperatorReguKontrol;
use App\Livewire\Operator\OperatorSoloKontrol;
use App\Livewire\Operator\OperatorTandingKontrol;
use App\Livewire\Operator\OperatorTunggalKontrol;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Operator;
use App\Http\Middleware\Dewan;
use App\Http\Middleware\Juri;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTGRController;
use App\Http\Controllers\Admin\AdminTandingController;
use App\Http\Controllers\Admin\AdminPengundianTandingController;
use App\Http\Controllers\Admin\AdminPengundianTGRController;
use App\Http\Controllers\Admin\AdminBaganController;
use App\Http\Controllers\Admin\AdminJadwalTandingController;
use App\Http\Controllers\Admin\AdminJadwalTGRController;
use App\Http\Controllers\Admin\AdminTimbangUlangController;
use App\Http\Controllers\Admin\AdminKontrolTandingController;
use App\Http\Controllers\Admin\AdminKontrolTGRController;
use App\Http\Controllers\Admin\AdminGelanggangController;
use App\Http\Controllers\Penonton\KetuaPertandinganController;
use App\Http\Controllers\Penonton\PenontonController;
use App\Livewire\Dewan\DewanTanding;
use App\Livewire\Juri\JuriTanding;
use App\Livewire\Penonton\PenontonTanding;
use App\Livewire\KetuaPertandingan\KetuaTanding;
use App\Livewire\Dewan\DewanTunggal;
use App\Livewire\Juri\JuriTunggal;
use App\Livewire\Penonton\PenontonTunggal;
use App\Livewire\KetuaPertandingan\KetuaTunggal;
use App\Livewire\Dewan\DewanRegu;
use App\Livewire\Juri\JuriRegu;
use App\Livewire\Penonton\PenontonRegu;
use App\Livewire\KetuaPertandingan\KetuaRegu;
use App\Livewire\Dewan\DewanGanda;
use App\Livewire\Juri\JuriGanda;
use App\Livewire\Penonton\PenontonGanda;
use App\Livewire\KetuaPertandingan\KetuaGanda;
use App\Livewire\Dewan\DewanSolo;
use App\Livewire\Juri\JuriSolo;
use App\Livewire\Penonton\PenontonSolo;
use App\Livewire\KetuaPertandingan\KetuaSolo;




Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/jadwal/{user}/{gelanggang}', MenungguJadwal::class)->name('menunggu-jadwal');


//CMS PENONTON
Route::get('/penonton', [PenontonController::class, 'index'])->name('penonton');
Route::get('/penonton/{gelanggang_id}', [PenontonController::class, 'auth']);
Route::get('/tanding/{gelanggang_id}', PenontonTanding::class)->name('tanding');
Route::get('/tunggal/{gelanggang_id}', PenontonTunggal::class)->name('tunggal');
Route::get('/regu/{gelanggang_id}', PenontonRegu::class)->name('regu');
Route::get('/ganda/{gelanggang_id}', PenontonGanda::class)->name('ganda');
Route::get('/solo/{gelanggang_id}', PenontonSolo::class)->name('solo');



//CMS KETUA PERTANDINGAN
Route::get('/ketuapertandingan', [KetuaPertandinganController::class, 'index'])->name('ketuapertandingan');
Route::get('/ketuapertandingan/{gelanggang_id}', [KetuaPertandinganController::class, 'auth']);
Route::get('/ketuapertandingan/tanding/{gelanggang_id}', KetuaTanding::class)->name('ketua.tanding');
Route::get('/ketuapertandingan/tunggal/{gelanggang_id}', KetuaTunggal::class)->name('ketua.tunggal');
Route::get('/ketuapertandingan/regu/{gelanggang_id}', KetuaRegu::class)->name('ketua.regu');
Route::get('/ketuapertandingan/ganda/{gelanggang_id}', KetuaGanda::class)->name('ketua.ganda');
Route::get('/ketuapertandingan/solo/{gelanggang_id}', KetuaSolo::class)->name('ketua.solo');


Auth::routes();

Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/auth', [AuthController::class, 'checkUser'])->name('checkuser');

  // CMS ADMIN
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

    // Pengundian Tanding
    Route::get('/pengundian-tanding', [AdminPengundianTandingController::class, 'index'])->name('pengundian-tanding.index');
    Route::post('/pengundian-tanding', [AdminPengundianTandingController::class, 'store'])->name('pengundian-tanding.store');
    Route::get('/pengundian-tanding/table/{golongan}/{jenis_kelamin}/{kelas}', [AdminPengundianTandingController::class, 'table'])->name('pengundian-tanding.table');
    Route::put('/pengundian-tanding/{id}/update', [AdminPengundianTandingController::class, 'update'])->name('pengundian-tanding.update');
    Route::delete('/pengundian-tanding/{id}/destroy', [AdminPengundianTandingController::class, 'destroy'])->name('pengundian-tanding.destroy');
    Route::delete('/pengundian-tanding/destroy-all', [AdminPengundianTandingController::class, 'destroyAll'])->name('pengundian-tanding.destroy-all');

    // Pengundian TGR
    Route::get('/pengundian-tgr', [AdminPengundianTGRController::class, 'index'])->name('pengundian-tgr.index');
    Route::post('/pengundian-tgr', [AdminPengundianTGRController::class, 'store'])->name('pengundian-tgr.store');
    Route::get('/pengundian-tgr/table/{golongan}/{jenis_kelamin}/{kategori}', [AdminPengundianTGRController::class, 'table'])->name('pengundian-tgr.table');
    Route::put('/pengundian-tgr/{id}/update', [AdminPengundianTGRController::class, 'update'])->name('pengundian-tgr.update');
    Route::delete('/pengundian-tgr/{id}/destroy', [AdminPengundianTGRController::class, 'destroy'])->name('pengundian-tgr.destroy');
    Route::delete('/pengundian-tgr/destroy-all', [AdminPengundianTGRController::class, 'destroyAll'])->name('pengundian-tgr.destroy-all');

    // Bagan
    Route::get('/bagan-tanding', [AdminBaganController::class, 'tanding'])->name('bagan.tanding');
    Route::post('/bagan-tanding', [AdminBaganController::class, 'generateTanding'])->name('generate.tanding');
    Route::get('/bagan-tgr', [AdminBaganController::class, 'tgr'])->name('bagan.tgr');
    Route::post('/bagan-tgr', [AdminBaganController::class, 'generateTGR'])->name('generate.tgr');

    // Jadwal Tanding
    Route::get('/jadwal-tanding', [AdminJadwalTandingController::class, 'index'])->name('jadwal-tanding.index');
    Route::post('/jadwal-tanding', [AdminJadwalTandingController::class, 'store'])->name('jadwal-tanding.store');
    Route::put('/jadwal-tanding/{id}/update', [AdminJadwalTandingController::class, 'update'])->name('jadwal-tanding.update');
    Route::delete('/jadwal-tanding/{id}/destroy', [AdminJadwalTandingController::class, 'destroy'])->name('jadwal-tanding.destroy');
    Route::post('/jadwal-tanding/upload', [AdminJadwalTandingController::class, 'import'])->name('jadwal-tanding.import');
    Route::delete('/jadwal-tanding/destroy-all', [AdminJadwalTandingController::class, 'destroyAll'])->name('jadwal-tanding.destroy-all');

    // Jadwal TGR
    Route::get('/jadwal-tgr', [AdminJadwalTGRController::class, 'index'])->name('jadwal-tgr.index');
    Route::post('/jadwal-tgr', [AdminJadwalTGRController::class, 'store'])->name('jadwal-tgr.store');
    Route::put('/jadwal-tgr/{id}/update', [AdminJadwalTGRController::class, 'update'])->name('jadwal-tgr.update');
    Route::delete('/jadwal-tgr/{id}/destroy', [AdminJadwalTGRController::class, 'destroy'])->name('jadwal-tgr.destroy');
    Route::post('/jadwal-tgr/upload', [AdminJadwalTGRController::class, 'import'])->name('jadwal-tgr.import');
    Route::delete('/jadwal-tgr/destroy-all', [AdminJadwalTGRController::class, 'destroyAll'])->name('jadwal-tgr.destroy-all');

    // Timbang Ulang
    Route::get('/timbang-ulang', [AdminTimbangUlangController::class, 'index'])->name('timbang-ulang.index');
    Route::post('/timbang-ulang', [AdminTimbangUlangController::class, 'store'])->name('timbang-ulang.store');
    Route::put('/timbang-ulang/{id}/update', [AdminTimbangUlangController::class, 'update'])->name('timbang-ulang.update');
    Route::put('/timbang-ulang/{id}/destroy', [AdminTimbangUlangController::class, 'destroy'])->name('timbang-ulang.destroy');

    // gelanggang
    Route::get('/gelanggang', [AdminGelanggangController::class, 'index'])->name('gelanggang.index');
    Route::post('/gelanggang', [AdminGelanggangController::class, 'store'])->name('gelanggang.store');
    Route::put('/gelanggang/{id}/update', [AdminGelanggangController::class, 'update'])->name('gelanggang.update');
    Route::delete('/gelanggang/{id}/destroy', [AdminGelanggangController::class, 'destroy'])->name('gelanggang.destroy');
    Route::post('/gelanggang/upload', [AdminGelanggangController::class, 'import'])->name('gelanggang.import');
    Route::delete('/gelanggang/destroy-all', [AdminGelanggangController::class, 'destroyAll'])->name('gelanggang.destroy-all');

    // Kontrol Tanding
    Route::get('/kontrol-tanding', [AdminKontrolTandingController::class, 'index'])->name('kontrol-tanding.index');

    // Kontrol Tgr
    Route::get('/kontrol-tgr', [AdminKontrolTGRController::class, 'index'])->name('kontrol-tgr.index');
  });

  // CMS Operator
  Route::middleware([Operator::class])->name('op.')->prefix('op')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Timbang Ulang
    Route::get('/timbang-ulang', [AdminTimbangUlangController::class, 'index'])->name('timbang-ulang.index');
    Route::post('/timbang-ulang', [AdminTimbangUlangController::class, 'store'])->name('timbang-ulang.store');
    Route::put('/timbang-ulang/{id}/update', [AdminTimbangUlangController::class, 'update'])->name('timbang-ulang.update');
    Route::delete('/timbang-ulang/{id}/destroy', [AdminTimbangUlangController::class, 'destroy'])->name('timbang-ulang.destroy');

    // Kontrol Tanding
    Route::get('/kontrol-tanding', OperatorJadwalTanding::class)->name('kontrol-tanding.index');
    Route::post('/ubah/{jadwal_tanding_id}', [AdminKontrolTandingController::class, 'ubahtahap']);
    Route::post('/stop/{jadwal_tanding_id}', [AdminKontrolTandingController::class, 'stop_pertandingan']);
    Route::post('/reset/{jadwal_tanding_id}', [AdminKontrolTandingController::class, 'reset']);
    Route::get('/kontrol-tanding/{jadwal_tanding_id}', OperatorTandingKontrol::class);


    // Kontrol Tgr
    Route::get('/kontrol-tgr', OperatorJadwalTGR::class)->name('kontrol-tgr.index');
;
    Route::post('/ubah-tgr/{jadwal_tgr_id}/{jenis}', [AdminKontrolTGRController::class, 'ubahtahap']);
    Route::post('/stop-tgr/{jadwal_tgr_id}', [AdminKontrolTGRController::class, 'stop_pertandingan']);
    Route::post('/reset-tgr/{jadwal_tgr_id}', [AdminKontrolTGRController::class, 'reset']);
    //tunggal
    Route::get('/kontrol-tgr/tunggal/{jadwal_tunggal_id}', OperatorTunggalKontrol::class);
    //ganda
    Route::get('/kontrol-tgr/ganda/{jadwal_ganda_id}', OperatorGandaKontrol::class);
    //regu
    Route::get('/kontrol-tgr/regu/{jadwal_regu_id}', OperatorReguKontrol::class);
    //solo
    Route::get('/kontrol-tgr/solo/{jadwal_solo_id}', OperatorSoloKontrol::class);
  });

  // CMS Dewan
  Route::middleware([Dewan::class])->name('dewan.')->prefix('dewan')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tanding', DewanTanding::class)->name('tanding');
    Route::get('/tunggal', DewanTunggal::class)->name('tunggal');
    Route::get('/ganda', DewanGanda::class)->name('ganda');
    Route::get('/regu', DewanRegu::class)->name('regu');
    Route::get('/solo', DewanSolo::class)->name('solo');
  });

  // CMS Juri
  Route::middleware([Juri::class])->name('juri.')->prefix('juri')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tanding', JuriTanding::class)->name('tanding');
    Route::get('/tunggal', JuriTunggal::class)->name('tunggal');
    Route::get('/regu', JuriRegu::class)->name('regu');
    Route::get('/ganda', JuriGanda::class)->name('ganda');
    Route::get('/solo', JuriSolo::class)->name('solo');
  });
});
