<?php

use App\Http\Controllers\API\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Diagnosa\DianosaController;
use App\Http\Controllers\API\Diagnosa\TestDiagnosaController;
use App\Http\Controllers\Api\Pilihan_Paket\InputPesananController;
use App\Http\Controllers\API\Pilihan_Paket\PilihanPaketController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\User\UserlocationController;
use App\Models\PilihanPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route Taroh Disini Ya!
//Ai / Klasifikasi
Route::get("/get", [TestDiagnosaController::class, "index"]);
Route::post("/send-klasifikasi", [DianosaController::class, "sendFile"])->name('upload.file');


//Input Pesanan
Route::get("/inputpesanan", [InputPesananController::class, "index"]);
Route::post("/inputpesanan", [InputPesananController::class, "store"]);
Route::put("/inputpesanan/{id}", [InputPesananController::class, "update"]);
Route::delete("/inputpesanan/{id}", [InputPesananController::class, "destroy"]);

//Pilihan Paket

Route::get("/input_pilihan_paket", [PilihanPaketController::class, "index"]);
Route::post("/input_pilihan_paket", [PilihanPaketController::class, "store"]);
Route::put("/input_pilihan_paket/{id}", [PilihanPaketController::class, "update"]);
Route::delete("/input_pilihan_paket/{id}", [PilihanPaketController::class, "destroy"]);

//Akun Konsumen
Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::put("/userupdate/{id}", [UserController::class, "update"]);
Route::delete("/deleteuser/{id}",[UserController::class,"delete"]);
Route::get("/datauser",[UserController::class,"index"]);

Route::get("/lokasi",[UserlocationController::class,"lokasi"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/detailuserlogin', function (Request $request) {
        return $request->user();
    });
    Route::get("/logout",[UserController::class,"logout"]);

});
