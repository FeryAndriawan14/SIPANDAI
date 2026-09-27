<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Masyarakat\DashboardController;
use App\Http\Controllers\Masyarakat\PermohonanController;
use App\Http\Controllers\Masyarakat\TrackingController;
use App\Http\Controllers\Masyarakat\ArsipController;
use App\Http\Controllers\Masyarakat\BantuanController;
use App\Http\Controllers\Masyarakat\ProfilController;
use App\Http\Controllers\Operator\PermohonanController as OperatorPermohonanController;
use App\Http\Controllers\Operator\ProfileController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/layanan', [AdminController::class, 'layanan'])->name('layanan');
        Route::post('/layanan', [AdminController::class, 'storeLayanan'])->name('layanan.store');
        Route::delete('/layanan/{id}', [AdminController::class, 'destroyLayanan'])->name('layanan.destroy');
        Route::get('/audit/download', [AdminController::class, 'downloadAuditReport'])->name('audit.download');
        // profil admin:
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('password.update');
    });

    // Operator Routes
    // Route::get('/operator/dashboard', function () {
    //    return view('operator.dashboard');
    // })->name('operator.dashboard');

    // Route khusus Operator
    Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', [OperatorPermohonanController::class, 'index'])->name('dashboard');
        Route::get('/permohonan/{id}', [OperatorPermohonanController::class, 'show'])->name('permohonan.show');
        Route::put('/permohonan/{id}', [OperatorPermohonanController::class, 'update'])->name('permohonan.update');
        // Rute Baru
        Route::get('/riwayat', [OperatorPermohonanController::class, 'riwayat'])->name('riwayat');
        Route::get('/laporan', [OperatorPermohonanController::class, 'laporan'])->name('laporan');
        Route::get('/laporan/cetak-pdf', [OperatorPermohonanController::class, 'cetakPdf'])->name('laporan.pdf');
        Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    });

    // Masyarakat Routes (Bersih tanpa error closure)
    Route::prefix('masyarakat')->name('masyarakat.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/permohonan/create', [PermohonanController::class, 'create'])->name('permohonan.create');
        Route::post('/permohonan', [PermohonanController::class, 'store'])->name('permohonan.store');
        Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
        Route::get('/tracking/{id}', [TrackingController::class, 'show'])->name('tracking.show');
        Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
        Route::get('/arsip/download/{id}', [ArsipController::class, 'download'])->name('arsip.download');
        Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');
        Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    });
});
