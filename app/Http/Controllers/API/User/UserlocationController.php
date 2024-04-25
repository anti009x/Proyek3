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
        // dd($ipAddress);


try {
        if ($position) {
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
            // dd($request->ip());
        }
    } catch (\Exception $e) {
    return response()->json(['error'=> $e->getMessage()],404);
}


    // $position = Location::get('192.168.137.1');

    // dd($position);

    // if ($position){
    //     return response()->json([
    //         'message'=> true,
    //      'Posisi' => $position->countryName
    //     ]);
    // }else{
    //     return response()->json([
    //         'message'=>false
    //     ]);

    // }

    // if ($position = Location::get()) {
    //     // Successfully retrieved position.
    //     echo $position->countryName;
    // } else {
    //     // Failed retrieving position.
    // }

    }
}
    

