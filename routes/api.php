<?php

use App\Http\Controllers\API\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Diagnosa\DianosaController;
use App\Http\Controllers\API\Diagnosa\TestDiagnosaController;
use App\Http\Controllers\Api\InputPesananController;
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
Route::post("/send-klasifikasi", [DianosaController::class, "sendFile"])->name('upload.file');
Route::get("/get", [TestDiagnosaController::class, "index"]);
Route::get("/inputpesanan", [InputPesananController::class, "index"]);
Route::post("/inputpesanan", [InputPesananController::class, "store"]);
Route::put("/inputpesanan/{id}", [InputPesananController::class, "update"]);
Route::delete("/inputpesanan/{id}", [InputPesananController::class, "destroy"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
