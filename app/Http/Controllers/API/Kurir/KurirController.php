<?php

namespace App\Http\Controllers\API\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'role_id',
            'gaji',
            'nama',
            'nohp',
                    
        ]);

        $validatedData['nama'] = $user->nama;
        $inputPesanan = Kurir::create($validatedData);

        // Load data kurir terkait dengan pesanan yang baru dibuat
        $inputPesanan->load('kurir');

        return response()->json(['message' => 'Data Berhasil Ditambahkan', 'data' => $inputPesanan], 200);
    }


    public function index()
    {
        $kurir = Kurir::with('user')->get();

        if ($kurir->isNotEmpty()) {
            return response()->json([
                'message' => true,
                'Data Kurir' => $kurir
            ]);
        } else {
            return response()->json([
                'message' => false,
            ]);
        }
    }
}
