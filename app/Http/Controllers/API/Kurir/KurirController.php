<?php

namespace App\Http\Controllers\API\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index(){

        $kurir = Kurir::all();

        if ($kurir->isNotEmpty()){
            return response()->json([
                'massage' => true,
                'Data Kurir Nya' => $kurir
            ]);
        }else{
                return response()->json([
                    'massage'=>false,
                ]);
        }
    }


}
