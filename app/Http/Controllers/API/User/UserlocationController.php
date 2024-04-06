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
            $position = Location::get('http://192.168.100.56:8888');
            // echo $position;

            // $lokasi = "Indramayu";

         

            return response()->json([
                'Lokasi Anda'=>$position->countryName,
                'Code Lokasi Anda'=>$position->countryCode,
                'Kota Anda'=>$position->cityName,
                'Zip Code' => $position->zipCode
            ]);



        } else {
            // Failed retrieving position.
            echo("Data Not Found");
        }

    }


}
