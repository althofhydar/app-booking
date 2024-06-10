<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;


use App\Http\Controllers\HomeController;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\TicketController;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::controller(AuthController::class)->group(function() {
  Route::get('login', 'login')->name('login');
  Route::post('login', 'loginAksi')->name('login.aksi');

  Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
    return view('auth.login');
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

Route::middleware('auth')->group(function() {
    Route::get('events', function() {
        return view('events');
    })->name('events');

Route::controller(EventController::class)->prefix('event')->group(function() {
    Route::get('', 'index')->name('event.index');
    Route::get('tambah', 'tambah')->name('event.tambah');
    Route::post('store', 'store')->name('event.store');
    Route::get('edit/{id}', 'edit')->name('event.edit');
    Route::put('update/{id}', 'update')->name('event.update'); // Use PUT method
    Route::delete('destroy/{id}', 'destroy')->name('event.destroy'); // Use DELETE method
});
Route::controller(UserController::class)->prefix('user')->group(function() {
    Route::get('', 'index')->name('user.index');
    Route::get('tambah', 'tambah')->name('user.tambah');
    Route::post('store', 'store')->name('user.store');
    Route::get('edit/{id}', 'edit')->name('user.edit');
    Route::put('update/{id}', 'update')->name('user.update'); // Use PUT method
    Route::delete('destroy/{id}', 'destroy')->name('user.destroy'); // Use DELETE method
});
Route::controller(TicketController::class)->prefix('ticket')->group(function() {
    Route::get('', 'index')->name('ticket.index');
    Route::get('tambah', 'tambah')->name('ticket.tambah');
    Route::post('store', 'store')->name('ticket.store');
    Route::get('edit/{id}', 'edit')->name('ticket.edit');
    Route::put('update/{id}', 'update')->name('ticket.update'); // Use PUT method
    Route::delete('destroy/{id}', 'destroy')->name('ticket.destroy'); // Use DELETE method
});


});



});


Route::get( "/forget-password", [ForgetPassword::class, "forgetPassword"])->name(name: "forget.password");
Route::post( "/forget-password", [ForgetPassword::class, "forgetPasswordPost"])->name(name: "forget.password.post");
Route::get("/reset-password/{token}", [ForgetPassword::class, "resetPassword"])->name("reset.password");
Route::post("/reset-password", [ForgetPassword::class, "resetPasswordPost"])->name("reset.password.post");

Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('events', [HomeController::class, 'index'])->name('events');
Route::get('tickets', [HomeController::class, 'index'])->name('tickets');
Route::get('beli/{ticket:ticket_type}', [HomeController::class, 'beli'])->name('beli');
Route::get('/events', [HomeController::class, 'index'])->name('events');
Route::post('/submit-form', [HomeController::class, 'submitForm'])->name('submit-form');
Route::get('/checkout/{id}', [HomeController::class, 'checkout'])->name('checkout');

Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian');
Route::delete('destroy/{id}',[PembelianController::class, 'destroy'])->name('pembelian.destroy'); // Use DELETE method
Route::post('/pembelian/confirm/{id}', [PembelianController::class, 'confirm'])->name('pembelian.confirm');

Route::get('history', [HistoryController::class, 'index'])->name('history');
Route::post('/add-to-ceks', [HistoryController::class, 'addToCeks'] )->name('addToCeks');
// web.php
Route::post('/history/request-print', [HistoryController::class, 'requestPrint'])->name('history.requestPrint');

//admin
Route::get('/cek', [AdminController::class, 'cek'])->name('admin.cek');
Route::post('/confirm/{ticket_type}', [HistoryController::class, 'confirm'])->name('confirm');




