<?php

namespace App\Http\Controllers\Api;

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
            'Nama_Kurir' => 'required',
            'nama' => 'required',
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
            'Nama_Barang' => 'required',
            'Generate_Resi' => 'required',
            'Berat_Barang' => 'required',
            'Alamat_Tujuan' => 'required',
            'status_pembayaran' => 'required',
            'Nama_Kurir' => 'required',
            'nama' => 'required',
        ]);

        $id->update($request->all());
        
        return response()->json(['message' => 'Data Berhasil Di Ubah', 'Data' => $id], 200);
    }

    public function destroy($id)
    {
        $inputPesanan = InputPesanan::findOrFail($id);
        $inputPesanan->delete();
        
        return response()->json(['message' => 'Data Berhasil Dihapus'], 200);
    }
}
