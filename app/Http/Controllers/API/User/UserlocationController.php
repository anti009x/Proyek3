<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserlocationController extends Controller
{

    

    public function lokasi () {



        if ($position = Location::get()) {
            // Successfully retrieved position.
            $position = Location::get('http://192.168.137.129:8888/');
            // echo $position;

            // $lokasi = "Indramayu";

         

            return response()->json([
                'message' => [
                    'data'=>true,
                    'Lokasi_Anda'=>$position->countryName,
                    'Code_Lokasi_Anda'=>$position->countryCode,
                    'Kota_Anda'=>$position->cityName,
                    'Zip_Code' => $position->zipCode
                ]
            ]);



        } else {
            // Failed retrieving position.
            echo("Data Not Found");
        }

    }


}
