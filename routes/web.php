<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EkstrakurikulerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return response()->json('Hello World');
    });
    // Route::get('/admin', function () {
    //     return view('halaman-admin.index');
    // });
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_action', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login_action', [LoginController::class, 'login']);
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::middleware(['auth', 'verified', 'role_permission'])->group(function () {

    //users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    route::get('/users-create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users-store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/home', [LoginController::class, 'showChangePasswordForm']);
    Route::post('/home-post', [LoginController::class, 'changePasswordVerify']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/ekstraSiswa', [EkstrakurikulerController::class, 'indexSiswa'])->name('userSiswa.index');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index')->middleware('permission:view siswa');
    Route::get('/siswa-create', [SiswaController::class, 'create'])->name('siswa.create')->middleware('permission:create siswa');
    Route::post('/siswa-store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa-edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit')->middleware('permission:edit siswa');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update')->middleware('permission:update siswa');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // route kelas
    // Route untuk Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index')->middleware('permission:view kelas');
    Route::get('/kelas-create', [KelasController::class, 'create'])->name('kelas.create')->middleware('permission:create kelas');
    Route::post('/kelas-store', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas-edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas-update/{id}', [KelasController::class, 'update'])->name('kelas.update')->middleware('permission:update kelas');
    Route::delete('/kelas-delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy')->middleware('permission:delete kelas');

    // route kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index')->middleware('permission:view kategori');
    Route::get('/kategori-create', [KategoriController::class, 'create'])->name('halaman-admin.kategori.create');
    Route::post('/kategori-store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori-edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('permission:update kategori');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('permission:delete kategori');

    // route ekstrakurikuler
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index')->middleware('permission:view ekstrakurikuler');
    Route::get('/ekstrakurikuler-create', [EkstrakurikulerController::class, 'create'])->name('halaman-admin.ekstrakurikuler.create')->middleware('permission:create ekstrakurikuler');
    Route::post('/ekstrakurikuler-store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler-show/{id}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
    Route::get('/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit')->middleware('permission:edit ekstrakurikuler');
    Route::put('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update')->middleware('permission:update ekstrakurikuler');
    Route::delete('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy')->middleware('permission:delete ekstrakurikuler');
    // route logbook


    Route::get('/logbook', [LogbookController::class, 'index'])->name('halaman-admin.logbook.index')->middleware('permission:view logbook');
    Route::get('/logbook-create', [LogbookController::class, 'create'])->name('halaman-admin.logbook.create')->middleware('permission:create logbook');
    Route::post('/logbook-store', [LogbookController::class, 'store'])->name('logbook.store');
    Route::get('/logbook/{logbook}', [LogbookController::class, 'show'])->name('logbook.show');
    Route::get('/logbook-edit/{logbook}', [LogbookController::class, 'edit'])->name('logbook.edit')->middleware('permission:edit logbook');
    Route::post('/logbook/{logbook}', [LogbookController::class, 'update'])->name('logbook.update')->middleware('permission:update logbook');
    Route::delete('/logbook/{logbook}', [LogbookController::class, 'destroy'])->name('logbook.destroy')->middleware('permission:delete logbook');

    //route role
    Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role-edit/{id}/', [RoleController::class, 'edit'])->name('roles.edit');
    route::post('/role/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/{id}/manage-permissions', [RoleController::class, 'managePermissions'])->name('roles.manage-permissions');
    Route::post('/roles/{id}/update-permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
    Route::put('/{id}', [RoleController::class, 'update'])->name('update');
    Route::post('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
