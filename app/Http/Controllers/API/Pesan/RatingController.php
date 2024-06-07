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


        if ($user->limit_rating >= 1) {
            $validatedData = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'komentar' => 'nullable|string',
            ]);
    
            $ratingValue = $validatedData['rating'];
            $saran = $validatedData['komentar'] ?? '';
    
            switch ($ratingValue) {
                case 1:
                    $saran = 'Terlalu Kurang';
                    break;
                case 2:
                    $saran = 'Kurang';
                    break;
                case 3:
                    $saran = 'Cukup';
                    break;
                case 4:
                    $saran = 'Bagus';
                    break;
                case 5:
                    $saran = 'Sangat Bagus';
                    break;
            }
    
            $validatedData['nama'] = $user->nama;
            $validatedData['komentar'] = $saran;
            $rating = Rating::create($validatedData);
    
            if ($rating) {
                $user = $request->user();
                $user->limit_rating -= 1;
                $user->save();


                return response()->json([
                    'message' => true,
                    'Saran' => $saran,
                    'Data Berhasil Didapatkan' => $rating
                ]);
            } else {
                return response()->json([
                    'message' => false,
                ]);
            }



            
        }else {
            return response()->json([
                'message' => false,
                'Pesan' => 'Limit Token Anda Tidak Tersedia,Harap Melakukan CHeckout Pesanan !'
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