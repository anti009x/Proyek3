<?php

namespace App\Http\Controllers\API\Pesan;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\isActivate;

class RatingController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();

        $validatedData = $request->validate([
            'nama',
            'rating'=>'required',
            'saran'=>'required',

        ]);

        
        $validatedData['nama'] = $user->nama;
        $rating = Rating::create($validatedData);

        if($rating){
        return response()->json([
            'message'=>true,
            'Data Yang Terkirim adalah' => $rating
        ]);

        }else{
            return response()->json([
                'message'=>false,                
            ]);
        }



    }
    public function index(){

        ///ambil semua data rating tanpa terkecuali

        $ratings = Rating::all();

        return response()->json([
            'message' => true,
            'Data Berhasil Didapatkan' => $ratings
        ]);

        ///berdasarkan nama !
        // $user = Auth::user();

        // if ($user){
        //     $ratings = Rating::where('nama', $user->nama)->get();
        //     return response()->json([
        //     'message' => true,
        //     'Data Berhasil Didapatkan' => $ratings
        // ]);
        // }

        // if (!$user) {
        //     return response()->json([
        //         'message' => false,
        //         'Pesan' => 'Anda tidak login atau terjadi kesalahan data'
        //     ]);
        // }
        




    }

}
