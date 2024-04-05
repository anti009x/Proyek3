<?php

namespace App\Http\Controllers\API\Pilihan_Paket;

use App\Http\Controllers\Controller;
use App\Models\PilihanPaket;
use Illuminate\Http\Request;

class PilihanPaketController extends Controller
{
    public function index()
    {
        $PilihanPaket = PilihanPaket::all();
        return response()->json($PilihanPaket);
    }

    public function store(Request $request){
        $ValidateData = $request->validate([
            'Nama_Paket'=>'required',
            'Harga_Paket'=>'required',
        ]);

        $PilihanPaket = PilihanPaket::create($ValidateData);
        return response()->json(['message' => 'Data Berhasil Ditambahkan', 'data' => $PilihanPaket], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Paket',
            'Harga_Paket',
        ]);
    
        $PilihanPaket = PilihanPaket::findOrFail($id);
        $PilihanPaket->update($request->all());
        return response()->json(['message' => 'Data Berhasil Diubah', 'Data' => $PilihanPaket], 200);
    }

    public function destroy($id)
    {
        $PilihanPaket = PilihanPaket::find($id);
    

        if (!$PilihanPaket) {
            return response()->json(['message' => 'Data Tidak Ditemukan!'], 404);
        }
        $PilihanPaket->delete();
        
        return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
    }

}
