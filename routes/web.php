<?php

use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::controller(AuthController::class)->group(function() {
  Route::get('login', 'login')->name('login');
  Route::post('login', 'loginAksi')->name('login.aksi');

  Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, "register"])->name('register');
Route::post('/register', [AuthController::class, "registerProses"])->name('registerProses');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verication.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('login');
})->middleware(['auth', 'signed'])->name('verification.verify');





Route::middleware('auth')->group(function() {
Route::get('dashboard', function() {
    return view('dashboard');
})->name('dashboard');

route::controller(BarangController::class)->prefix('barang')->group(function() {
    route::get('', 'index')->name('barang');
    route::get('tambah', 'tambah')->name('barang.tambah');
    route::post('tambah', 'simpan')->name('barang.tambah.simpan');
    route::get('edit/{id}', 'edit')->name('barang.edit');
    route::post('edit/{id}', 'update')->name('barang.tambah.update');
    route::get('hapus/{id}', 'hapus')->name('barang.hapus');
    
});

 Route::controller(KategoriController::class)->prefix('kategori')->group(function() {
     Route::get('', 'index')->name('kategori');
     route::get('tambah', 'tambah')->name('kategori.tambah');
     route::post('tambah', 'simpan')->name('kategori.tambah.simpan');
     route::get('edit/{id}', 'edit')->name('kategori.edit');
     route::post('edit/{id}', 'update')->name('kategori.tambah.update');
     route::get('hapus/{id}', 'hapus')->name('kategori.hapus');
 });

});

Route::get( "/forget-password", [ForgetPassword::class, "forgetPassword"])->name(name: "forget.password");
Route::post( "/forget-password", [ForgetPassword::class, "forgetPasswordPost"])->name(name: "forget.password.post");
Route::get("/reset-password/{token}", [ForgetPassword::class, "resetPassword"])->name("reset.password");
Route::post("/reset-password", [ForgetPassword::class, "resetPasswordPost"])->name("reset.password.post");


