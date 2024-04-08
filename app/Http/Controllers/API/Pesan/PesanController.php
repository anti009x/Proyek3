<?php

namespace App\Http\Controllers\API\Pesan;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PesanController extends Controller
{
    public function kirimpesan(Request $request)
    {
 
        $user = Auth::id();


        $validatedData = $request->validate([
            'kirim_pesan' => 'required',
            'nama' => 'required',
        ]);


        $penerimaName = $request->input('nama');
        $kirimpesan = $request->input('kirim_pesan');


        $penerima = User::where('nama', $penerimaName)->first();

        $pengirim = 'userss_id';


        if ($user && $penerima) {

            $pesan = Pesan::create([
                $pengirim => $user, 
                'kirim_pesan' => $kirimpesan,
                'nama' => $penerimaName, 
            ]);

            return response()->json(['message' => 'Pesan berhasil dikirim', 'data' => $pesan], 200);
        } else {
            return response()->json(['message' => 'Pesan Gagal Terkirim / Penerima Tidak Ada !'], 404);
        }
    }
}