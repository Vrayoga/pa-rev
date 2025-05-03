<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\jadwalEkstrakurikulerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;


Route::middleware(['guest'])->group(function () {
    // Welcome page
    Route::get('/', function () {
        return response()->json('Hello World');
    });

    // Authentication routes
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_action', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login_action', [LoginController::class, 'login']);
});


//email verification
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});



Route::middleware(['auth', 'verified', 'role_permission'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Home & Password Change
    Route::get('/home', [LoginController::class, 'showChangePasswordForm']);
    Route::post('/home-post', [LoginController::class, 'changePasswordAndRegister'])->name('change.password.post');
    // Route::post('/home-post', [LoginController::class, 'changePasswordVerify']);

    // Users Management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:view user');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create user');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit user');
        Route::post('/{id}', [UserController::class, 'update'])->name('users.update')->middleware('permission:update user');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete user');
    });

    // Role Management
    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view role');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:create role');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit role');
        Route::post('/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:update role');
        Route::get('/{id}/manage-permissions', [RoleController::class, 'managePermissions'])->name('roles.manage-permissions');
        Route::post('/{id}/update-permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
        Route::post('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role')->middleware('permission:delete role');
    });

    // Siswa Management
    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index')->middleware('permission:view siswa');
        Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create')->middleware('permission:create siswa');
        Route::post('/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/edit/{siswa}', [SiswaController::class, 'edit'])->name('siswa.edit')->middleware('permission:edit siswa');
        Route::post('/{siswa}', [SiswaController::class, 'update'])->name('siswa.update')->middleware('permission:update siswa');
        Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy')->middleware('permission:delete siswa');
    });

    // Kelas Management
    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('kelas.index')->middleware('permission:view kelas');
        Route::get('/create', [KelasController::class, 'create'])->name('kelas.create')->middleware('permission:create kelas');
        Route::post('/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit')->middleware('permission:edit kelas');
        Route::put('/update/{id}', [KelasController::class, 'update'])->name('kelas.update')->middleware('permission:update kelas');
        Route::delete('/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy')->middleware('permission:delete kelas');
    });

    // Jadwal Management
    Route::prefix('jadwal')->group(function () {
        Route::get('/', [jadwalEkstrakurikulerController::class, 'index'])->name('jadwal.index');
        Route::get('/create', [JadwalEkstrakurikulerController::class, 'create'])->name('jadwal.create');
        Route::post('/store', [JadwalEkstrakurikulerController::class, 'store'])->name('jadwal.store');
        Route::get('/show/{id}', [JadwalEkstrakurikulerController::class, 'show'])->name('jadwal.show');
        Route::get('/edit/{id}', [JadwalEkstrakurikulerController::class, 'edit'])->name('jadwal.edit');
        Route::put('/{id}', [JadwalEkstrakurikulerController::class, 'update'])->name('jadwal.update');
        Route::post('/{id}', [JadwalEkstrakurikulerController::class, 'destroy'])->name('jadwal.destroy');
    });

    // Kategori Management
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index')->middleware('permission:view kategori');
        Route::get('/create', [KategoriController::class, 'create'])->name('halaman-admin.kategori.create')->middleware('permission:create kategori');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit')->middleware('permission:edit kategori');
        Route::put('/{kategori}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('permission:update kategori');
        Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('permission:delete kategori');
    });

    // Ekstrakurikuler Management
    Route::prefix('ekstrakurikuler')->group(function () {
        Route::get('/', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index')->middleware('permission:view ekstrakurikuler');
        Route::get('/create', [EkstrakurikulerController::class, 'create'])->name('halaman-admin.ekstrakurikuler.create')->middleware('permission:create ekstrakurikuler');
        Route::post('/store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
        Route::get('/show/{id}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
        // routes/web.php
        Route::get('/guru/ekstrakurikuler', [EkstrakurikulerController::class, 'ekstrakurikulerDiampu'])->name('guru.ekstrakurikuler');
        Route::get('/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit')->middleware('permission:edit ekstrakurikuler');
        Route::put('/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update')->middleware('permission:update ekstrakurikuler');
        Route::delete('/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy')->middleware('permission:delete ekstrakurikuler');
    });


    // Pendaftaran Ekstrakurikuler 
    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [PendaftaranController::class, 'showAnggota'])->name('pendaftaran.index')->middleware('permission:view pendaftaran');
        Route::get('/ekstra', [PendaftaranController::class, 'daftarEkstra'])->name('daftar.create')->middleware('permission:create pendaftaran');
        Route::post('/ekstra-store', [PendaftaranController::class, 'storeRegisEkstra'])->name('ekstraDaftar.store');
        Route::put('/{id}/validasi', [PendaftaranController::class, 'validasi'])->name('pendaftaran.validasi');

    });



    // Ekstrakurikuler Siswa
    Route::get('/ekstraSiswa', [EkstrakurikulerController::class, 'indexSiswa'])->name('userSiswa.index');

    // Logbook Management
    Route::prefix('logbook')->group(function () {
        Route::get('/', [LogbookController::class, 'index'])->name('logbook.index')->middleware('permission:view logbook');
        Route::get('/create', [LogbookController::class, 'create'])->name('logbook.create')->middleware('permission:create logbook');
        Route::post('/store', [LogbookController::class, 'store'])->name('logbook.store');
        Route::get('/{logbook}', [LogbookController::class, 'show'])->name('logbook.show');
        Route::get('/edit/{logbook}', [LogbookController::class, 'edit'])->name('logbook.edit')->middleware('permission:edit logbook');
        Route::post('/{logbook}', [LogbookController::class, 'update'])->name('logbook.update')->middleware('permission:update logbook');
        Route::delete('/{logbook}', [LogbookController::class, 'destroy'])->name('logbook.destroy')->middleware('permission:delete logbook');
    });

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
