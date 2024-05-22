<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::controller(AuthController::class)->group(function() {
  Route::get('login', 'login')->name('login');
  Route::post('login', 'loginAksi')->name('login.aksi');

  Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
    return view('login');
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

Route::controller(EventController::class)->prefix('event')->group(function() {
    Route::get('', 'index')->name('event.index');
    Route::get('tambah', 'tambah')->name('event.tambah');
    Route::post('store', 'store')->name('event.store');
    Route::get('edit/{id}', 'edit')->name('event.edit');
    Route::put('update/{id}', 'update')->name('event.update'); // Use PUT method
    Route::delete('destroy/{id}', 'destroy')->name('event.destroy'); // Use DELETE method
});

});


Route::get( "/forget-password", [ForgetPassword::class, "forgetPassword"])->name(name: "forget.password");
Route::post( "/forget-password", [ForgetPassword::class, "forgetPasswordPost"])->name(name: "forget.password.post");
Route::get("/reset-password/{token}", [ForgetPassword::class, "resetPassword"])->name("reset.password");
Route::post("/reset-password", [ForgetPassword::class, "resetPasswordPost"])->name("reset.password.post");


