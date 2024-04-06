<?php

namespace App\Http\Controllers\API\Pilihan_Paket;

use App\Http\Controllers\Controller;
use App\Models\InputPesanan;
use Illuminate\Http\Request;

class InputPesananController extends Controller
{
 
    public function index()
    {
        $inputPesanan = InputPesanan::all();
        return response()->json($inputPesanan);
    }

  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nama_Barang' => 'required',
            'Generate_Resi' => 'required',
            'Berat_Barang' => 'required',
            'Alamat_Tujuan' => 'required',
            'status_pembayaran' => 'required',
            // 'Nama_Kurir' => 'required',
            // // 'nama' => 'required',
            // 'Nama_Paket' => 'required',
        ]);

        $inputPesanan = InputPesanan::create($validatedData);
        return response()->json(['message' => 'Data Berhasil Ditambahkan', 'data' => $inputPesanan], 200);
    }


    public function show(InputPesanan $inputPesanan)
    {
        return response()->json($inputPesanan);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Barang',
            'Generate_Resi',
            'Berat_Barang' ,
            'Alamat_Tujuan',
            'status_pembayaran',
            // 'Nama_Kurir' => 'required',
            // 'nama' => 'required',
            // 'Nama_Paket' => 'required',
        ]);

        $inputPesanan = InputPesanan::findOrFail($id);
        $inputPesanan->update($request->all());
        
        return response()->json(['message' => 'Data Berhasil Di Ubah', 'Data' => $id , $inputPesanan], 200);
    }

    public function destroy($id)
    {
        $inputPesanan = InputPesanan::find($id);
    
        if (!$inputPesanan) {
            return response()->json(['message' => 'Data Tidak Ditemukan!'], 404);
        }
    
        $inputPesanan->delete();
    
        return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
    }
}
