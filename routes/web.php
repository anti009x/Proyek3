<?php

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Admin\LoginController;
use App\Http\Controllers\API\Admin\PesananController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\TestDiagnosaController;
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

Route::get('/', function () {
    return view('welcome');

});


Route::get('/dashboard', [AdminController::class, 'index']);
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/pilihanpaket', [PesananController::class, 'viewpesanan'])->name('pilihanpaket');
Route::delete('/pilihanpaket/{id}', [PesananController::class, 'delete'])->name('pilihanpaket.delete');
Route::post('/pilihanpaket', [PesananController::class, 'store'])->name('pilihanpaket.store');
Route::put('/pilihanpaket/{id}', [PesananController::class, 'update'])->name('pilihanpaket.update');
// Route::get('/user', [UserController::class, 'index'])->name('user');


Route::get('/user', [UserController::class, 'index'])->name('user');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

Route::get('/login', [LoginController::class, 'index'])->name('login');

