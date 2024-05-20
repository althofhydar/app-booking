<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function() {
    Route::get('login', 'login')->name('login');

    Route::post('login', 'loginAksi')->name('login.aksi');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');

Route::get('/', function () {
    return view('welcome');

});

});