<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\AlamatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatUserController extends Controller
{
    public function store(Request $request){

        $validatedData = $request->validate([
            'AlamatLengkap'=>'required'
        ]);

    
        $alamatlengkap = AlamatUser::create($validatedData);

        if($alamatlengkap){
        return response()->json([
            'message'=>true,
            'Data Yang Terkirim adalah' => $alamatlengkap
        ]);

        }else{
            return response()->json([
                'message'=>false,                
            ]);
        }



    }
}
