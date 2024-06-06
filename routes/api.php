<?php

use App\Http\Controllers\API\BeratBarang\BeratBarangController;
use App\Http\Controllers\API\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Diagnosa\DianosaController;
use App\Http\Controllers\API\Diagnosa\TestDiagnosaController;
use App\Http\Controllers\API\Kurir\KurirController;
use App\Http\Controllers\API\Pembayaran\MidtransController;
use App\Http\Controllers\API\Pengumuman\PengumumangController;
use App\Http\Controllers\API\Pesan\PesanController;
use App\Http\Controllers\API\Pesan\RatingController;
use App\Http\Controllers\API\Pilihan_Paket\InputPesananController;
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


//Kurir
Route::get('/datakurir',[UserController::class,'getdatakurir']);
Route::put('/updategajikurir/{nama_kurir}',[UserController::class,'updategajikurir']);

Route::post('/aftherpay',[MidtransController::class,'afterpay']);
Route::post('/afther-payment',[MidtransController::class,'aftherpay']);

Route::put("/changepassword/{email}",[UserController::class,"changepassword"]);

Route::put("/checkemail/{email}",[UserController::class,"checkavaiblemail"]);



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

Route::post("/send-otp-wa",[UserController::class,"send"]);
Route::post("/send-otp-email",[UserController::class,"sendemail"]);

    //Pilihan Paket
    Route::get("/input_pilihan_paket", [PilihanPaketController::class, "index"]);
    Route::post("/input_pilihan_paket", [PilihanPaketController::class, "store"]);
    Route::put("/input_pilihan_paket/{id}", [PilihanPaketController::class, "update"]);
    Route::delete("/input_pilihan_paket/{id}", [PilihanPaketController::class, "destroy"]);





Route::get("/lokasi",[UserlocationController::class,"lokasi"]);



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
    Route::delete("/inputpesanan/{id}", [InputPesananController::class, "destroypesanan"]);
    Route::get("/riwayatpesananuser", [InputPesananController::class, "allriwayatpesanan"]);
    Route::get("/riwayatpesananuser/{id}", [InputPesananController::class, "allriwayatpesananbyuser"]);
    Route::put("/riwayatpesananuser/{id}", [InputPesananController::class, "allriwayatpesananbyuserupdate"]);
    Route::put('/updatestatusbykurir/{id}',[InputPesananController::class,'updatestatusbykurir']);




    //Data Kurir
    Route::get("/kurir",[KurirController::class,"index"]);

    Route::post("/pesan",[PesanController::class,"kirimpesan"]);
    Route::get("/riwayatpesan", [PesanController::class, "riwayatpesan"]);
    Route::get("/riwayatpesan/{id}", [PesanController::class, "riwayatpesanbyid"]);

        //Akun Konsumen
        Route::get("/logout",[UserController::class,"logout"]);
        Route::put("/userupdate", [UserController::class, "update"]);
        Route::delete("/deleteuser/{id}",[UserController::class,"delete"]);
        Route::get("/datauser",[UserController::class,"index"]);

        Route::put("/updatenohp",[UserController::class,"updatenohp"]);


        // Route::get("/datakurir",[UserController::class,"datasemuauser"]);
        // Route::post("/datakurir",[KurirController::class,"store"]);

        //Rating

        Route::post("/rating",[RatingController::class,"store"]);

        Route::get("/data_rating",[RatingController::class,"index"]);
        Route::post("/pengumuman",[PengumumangController::class,"store"]);
        Route::get("/infopengumuman",[PengumumangController::class,"index"]);

        //Raja Ongkir
        Route::get('/riwayatpembayaran',[MidtransController::class,'riwayatopup']);
        Route::delete('/desytroypembayaran/{id}',[MidtransController::class,'desytroypembayaran']);
        Route::get('/riwayatpembayaran/{id}',[MidtransController::class,'riwayatopupbyid']);
        Route::get('/riwayatpembayaranbysaldo',[MidtransController::class,'riwayatopupbysaldo']);
        Route::put('/udpdatesaldo',[MidtransController::class,'updatesaldo']);

Route::get("/city",[RajaOngkirController::class,"city"]);
Route::get("/province",[RajaOngkirController::class,"province"]);
// Route::get("/city",[RajaOngkirController::class,"pilihanalamat"]);
// Route::get("/city",[RajaOngkirController::class,"pilihanalamat"]);

Route::post('/topup',[MidtransController::class,'create']);
// Route::post('/topup',[MidtransController::class,'create']);

//Barang
// Route::get("/beratbarang",[BeratBarangController::class,"index"]);
Route::post("/beratbarang",[BeratBarangController::class,"store"]);



});
