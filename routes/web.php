<?php

use App\Http\Controllers\API\Admin\AdminController;
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
Route::get('/user', [UserController::class, 'index'])->name('user');

