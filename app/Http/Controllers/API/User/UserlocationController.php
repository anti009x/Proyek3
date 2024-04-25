<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserlocationController extends Controller
{

    

<<<<<<< HEAD
    public function lokasi () {



        if ($position = Location::get()) {
            // Successfully retrieved position.
            $position = Location::get('http://192.168.137.129:8888/');
            // echo $position;

            // $lokasi = "Indramayu";

         

=======
    public function lokasi(Request $request) {
        // $ipAddress = $request->ip();
        $position = Location::get('https://'.$request->ip());
        //dd($ipAddress)
        if ($position) {
>>>>>>> 7664ea6a1c202cf41bc05c2cb7a50cce9803a937
            return response()->json([
                'message' => [
                    'data'=>true,
                    'Lokasi_Anda'=>$position->countryName,
                    'Code_Lokasi_Anda'=>$position->countryCode,
                    'Kota_Anda'=>$position->cityName,
                    'Zip_Code' => $position->zipCode,
                    'longitude'  => $position -> longitude,
                    'latitude' => $position  ->  latitude ,
                    // 'Area'=>$position ->areaCode
                ]
            ]);
        } else {
            return response()->json(['error' => 'Lokasi Tidak Ditemukan'], 404);
        }
    }


}
