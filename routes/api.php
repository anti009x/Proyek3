<?php

use App\Http\Controllers\API\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Diagnosa\DianosaController;
use App\Http\Controllers\API\Diagnosa\TestDiagnosaController;
use App\Http\Controllers\API\Kurir\KurirController;
use App\Http\Controllers\API\Pesan\PesanController;
use App\Http\Controllers\API\Pesan\RatingController;
use App\Http\Controllers\Api\Pilihan_Paket\InputPesananController;
use App\Http\Controllers\API\Pilihan_Paket\PilihanPaketController;
use App\Http\Controllers\API\Pilihan_Paket\RajaOngkirController;
use App\Http\Controllers\API\User\PembayaranController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\User\UserlocationController;
use App\Models\Pembayaran;
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


//Midtrans
Route::post('/payment', [PembayaranController::class, 'pay']); #->name('donation.pay'); -- route sebelumnya woy !! janagn pake itu
Route::get('/payment',[PembayaranController::class,'index']);

///Bug Gk Tau pusing gw kenapa ini harus disini
Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);

    //Pilihan Paket
    Route::get("/input_pilihan_paket", [PilihanPaketController::class, "index"]);
    Route::post("/input_pilihan_paket", [PilihanPaketController::class, "store"]);
    Route::put("/input_pilihan_paket/{id}", [PilihanPaketController::class, "update"]);
    Route::delete("/input_pilihan_paket/{id}", [PilihanPaketController::class, "destroy"]);





Route::get("/lokasi",[UserlocationController::class,"lokasi"]);

//Raja Ongkir

Route::get("/city",[RajaOngkirController::class,"city"]);
Route::get("/province",[RajaOngkirController::class,"province"]);
// Route::get("/city",[RajaOngkirController::class,"pilihanalamat"]);
// Route::get("/city",[RajaOngkirController::class,"pilihanalamat"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/detailuserlogin', function (Request $request) {
        return $request->user();
    });


    //Input Pesanan
        //Riwayat Pesanan
        Route::get("/riwayatpesanan", [InputPesananController::class, "riwayatpesanan"]);
        Route::get("/riwayatpesanan/{id}", [InputPesananController::class, "riwayatpesananbyid"]);
    Route::post("/inputpesanan", [InputPesananController::class, "store"]);
    Route::put("/inputpesanan/{id}", [InputPesananController::class, "update"]);
    Route::delete("/inputpesanan/{id}", [InputPesananController::class, "destroy"]);

    //Data Kurir
    Route::get("/kurir",[KurirController::class,"index"]);

    Route::post("/pesan",[PesanController::class,"kirimpesan"]);

        //Akun Konsumen
        Route::get("/logout",[UserController::class,"logout"]);
        Route::put("/userupdate", [UserController::class, "update"]);
        Route::delete("/deleteuser/{id}",[UserController::class,"delete"]);
        Route::get("/datauser",[UserController::class,"index"]);
        Route::get("/datakurir",[UserController::class,"datasemuauser"]);

        //Rating

        Route::post("/rating",[RatingController::class,"store"]);

        Route::get("/data_rating",[RatingController::class,"index"]);
    

});
