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
        $user2 = Auth::user();

        if ($user2) {
            $validatedData = $request->validate([
                'kirim_pesan' => 'required',
                'nama_penerima' => 'required',
                'nama_pengirim' => 'sometimes',
            ]);

            $penerimaName = $request->input('nama_penerima');
            $kirimpesan = $request->input('kirim_pesan');
            $validatedData['nama_pengirim'] = $user2->nama;

            $penerima = User::where('nama', $penerimaName)->first();

            if ($user && $penerima) {
                $pesan = Pesan::create([
                    'userss_id' => $user,
                    'kirim_pesan' => $kirimpesan,
                    'nama_pengirim' => $user2->nama,
                    'nama_penerima' => $penerimaName,
                ]);

                return response()->json(['message' => 'Pesan berhasil dikirim', 'data' => $pesan], 200);
            } else {
                return response()->json(['message' => 'Pesan Gagal Terkirim / Penerima Tidak Ada!'], 404);
            }
        }

    }

    public function riwayatpesan()
    {
        $user = Auth::user();

        if ($user) {
            $riwayatpesan = Pesan::where('userss_id', $user->id)->get();

            return response()->json(['message' => 'Riwayat Pesan', 'data' => $riwayatpesan], 200);
        }

        if (!$user) {
            return response()->json(['message' => 'User Tidak Ditemukan'], 404);
        }

        // if (!$riwayatpesan) {
        //     return response()->json(['message' => 'Riwayat Pesan Tidak Ditemukan'], 404);
        // }
        

    }


    public function riwayatpesanbyid($id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User Tidak Ditemukan'], 404);
        }

        $riwayatpesan = Pesan::all();

        if ($riwayatpesan->isEmpty()) {
            return response()->json(['message' => 'Riwayat Pesan Tidak Ditemukan'], 404);
        }

        return response()->json(['message' => 'Riwayat Pesan', 'data' => $riwayatpesan], 200);
    }
}