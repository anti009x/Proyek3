<?php

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Admin\LoginController;
use App\Http\Controllers\API\Admin\PesananController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\TestDiagnosaController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

use App\Providers\HealthServiceProvider;
use App\Checks\ServerStatus;
use App\Http\Controllers\API\Admin\ChattingController;
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

// Route::get('/', function () {
//     return view('welcome');

// });



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

Route::post('/postlogin', [LoginController::class, 'login'])->name('postlogin');

Route::middleware(['auth', 'ceklevel:1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
// Route::get('/DataAkun', [PesananController::class, 'index'])->name('admin.pesanan');
Route::get('/pilihanpaket', [PesananController::class, 'viewpesanan'])->name('pilihanpaket');
Route::delete('/pilihanpaket/{id}', [PesananController::class, 'delete'])->name('pilihanpaket.delete');
Route::post('/pilihanpaket', [PesananController::class, 'store'])->name('pilihanpaket.store');
Route::put('/pilihanpaket/{id}', [PesananController::class, 'update'])->name('pilihanpaket.update');
// Route::get('/user', [UserController::class, 'index'])->name('user');


// Route::get('/user', [UserController::class, 'index'])->name('user');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');



Route::get('/admin', [UserController::class,'admin'])->name('admin');
Route::get('/pengguna', [UserController::class,'konsumen'])->name('pengguna');
Route::get('/kurir', [UserController::class,'kurir'])->name('kurir');
// Route::get('/DataAkun', [UserController::class,'index'])->name('DataAkun');
Route::get('/ServerStatus', HealthCheckResultsController::class)->name('ServerStatus');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/userData', [UserController::class, 'userData'])->name('userData');
Route::get('/chatting', [ChattingController::class, 'index'])->name('chatting');
Route::post('/sendMessage', [ChattingController::class, 'sendMessage'])->name('sendMessage');
// Route::get('health', HealthCheckResultsController::class);

});