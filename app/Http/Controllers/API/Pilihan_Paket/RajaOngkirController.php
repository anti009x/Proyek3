<?php

namespace App\Http\Controllers\API\Pilihan_Paket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Laravel\Prompts\error;

class RajaOngkirController extends Controller
{
    public function city()
    {
        $city = Http::withHeaders([
            'key' => '0cb07c951c078fbe2b53311eec7115a4'
        ])->get('https://api.rajaongkir.com/starter/city');


            try {
                if ($city) {
                    return response()->json([
                        'message' => true,
                        'data_city' => $city->json()
                    ]);
                }
            } catch (\Exception $error) {
                return response()->json([
                    'message' => false,
                    'data_city' => $error->getMessage()
                ]);
            }



    }
    public function province()
    {
        $province = Http::withHeaders([
            'key' => '0cb07c951c078fbe2b53311eec7115a4'
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($province) {
            return response()->json([
                'message' => true,
                'data_province' => $province->json()
            ]);
        } else {
            return response()->json([
                'message' => false,
                'data_province' => 'tidak ditemukan'
            ]);
        }
    }
}
