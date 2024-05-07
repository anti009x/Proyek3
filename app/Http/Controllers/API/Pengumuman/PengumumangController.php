<?php

namespace App\Http\Controllers\API\Pengumuman;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumangController extends Controller
{
    public function store(Request $request){

        $user = Auth::user();
        $validateData = $request->validate([
            'nama',
            'deskripsi' => 'required',
        ]);

        $validateData['nama'] = $user->nama;
        $pengumuman = Pengumuman::create($validateData);
        return response()->json([
            'message' => 'Pengumuman berhasil dibuat',
            'data' => $pengumuman,
        ], 201);

    }

    public function index(){
        $pengumuman = Pengumuman::all();
        return response()->json([
            'message' => 'Berhasil mengambil data pengumuman',
            'data' => $pengumuman,
        ]);
    }


}
