<?php

namespace App\Http\Controllers\API\BeratBarang;

use App\Http\Controllers\Controller;
use App\Models\PilihanBerat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeratBarangController extends Controller
{
        public function store (Request $request){

            $user = Auth::user();

            $validatedData = $request->validate([

                'Berat_kg'=>'required',

            ]);
            if ($user->role_id == 1) {
                $beratbarang = PilihanBerat::create($validatedData);
                return response()->json([
                    'message' => 'Berat Barang Created Successfully',
                    'data' => $beratbarang
                ]); 

            } else {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 403);
            }
        

        }
}
