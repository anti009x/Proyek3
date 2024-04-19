<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserlocationController extends Controller
{

    

    public function lokasi(Request $request) {
        // $ipAddress = $request->ip();
        $position = Location::get('https://'.$request->ip());
        //dd($ipAddress)
        if ($position) {
            return response()->json([
                'message' => [
                    'data'=>true,
                    'Lokasi_Anda'=>$position->countryName,
                    'Code_Lokasi_Anda'=>$position->countryCode,
                    'Kota_Anda'=>$position->cityName,
                    'Zip_Code' => $position->zipCode,
                    'longitude'  => $position -> longitude,
                    'latitude' => $position  ->  latitude 
                ]
            ]);
        } else {
            return response()->json(['error' => 'Lokasi Tidak Ditemukan'], 404);
        }
    }


}
