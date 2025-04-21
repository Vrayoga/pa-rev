<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


    Route::get('/home', [LoginController::class, 'showChangePasswordForm']);
    Route::post('/home-post', [LoginController::class, 'changePasswordVerify']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa-create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa-store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/siswa-edit/{siswa}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // route kelas
   // Route untuk Kelas
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/kelas-create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas-store', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
Route::get('/kelas-edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas-update/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas-delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // route kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori-create', [KategoriController::class, 'create'])->name('halaman-admin.kategori.create');
    Route::post('/kategori-store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori-edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // route ekstrakurikuler
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
    Route::get('/ekstrakurikuler-create', [EkstrakurikulerController::class, 'create'])->name('halaman-admin.ekstrakurikuler.create');
    Route::post('/ekstrakurikuler-store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
    Route::get('/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');
    // route logbook
    Route::get('/logbook', [LogbookController::class, 'index'])->name('halaman-admin.logbook.index');
    Route::get('/logbook-create', [LogbookController::class, 'create'])->name('halaman-admin.logbook.create');
    Route::post('/logbook-store', [LogbookController::class, 'store'])->name('logbook.store');
    Route::get('/logbook/{logbook}', [LogbookController::class, 'show'])->name('logbook.show');
    Route::get('/logbook/{logbook}/edit', [LogbookController::class, 'edit'])->name('logbook.edit');
    Route::put('/logbook/{logbook}', [LogbookController::class, 'update'])->name('logbook.update');
    Route::delete('/logbook/{logbook}', [LogbookController::class, 'destroy'])->name('logbook.destroy');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
