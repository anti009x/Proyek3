<?php

use App\Http\Controllers\API\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Diagnosa\DianosaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
