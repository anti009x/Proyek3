<?php

namespace App\Http\Controllers\API\Pilihan_Paket;

use App\Http\Controllers\Controller;
use App\Models\InputPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class InputPesananController extends Controller
{
    public function riwayatpesanan()
    {   
        $user = Auth::user();

        if ($user){
            // Menggunakan  loading untuk mengambil data pilihan paket, termasuk data kurir terkait dengan setiap pesanan
            $inputPesanan = InputPesanan::with('pilihanPaketByNama', 'pilihanPaketByHarga', 'kurir')
                                        ->where('nama', $user->nama)
                                        ->get();

            return response()->json($inputPesanan);
        } else {
            return response()->json(['message' => false]);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'Nama_Barang'=>'required',
            'Alamat_Tujuan'=>'required',
            'Nama_Paket'=>'required',
            'Harga_Paket'=>'required',
            'Nama_Kurir'=>'required',
        ]);

        $validatedData['nama'] = $user->nama;
        $inputPesanan = InputPesanan::create($validatedData);

        // Load data kurir terkait dengan pesanan yang baru dibuat
        $inputPesanan->load('kurir');

        return response()->json(['message' => 'Data Berhasil Ditambahkan', 'data' => $inputPesanan], 200);
    }

    public function show(InputPesanan $inputPesanan)
    {
        // Menggunakan eager loading untuk mengambil data pilihan paket terkait dengan pesanan
        $inputPesanan->load('pilihanPaketByNama', 'pilihanPaketByHarga');
        
        return response()->json($inputPesanan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Barang'=>'required',
            'Alamat_Tujuan'=>'required',
            'Nama_Paket'=>'required',
            'Harga_Paket'=>'required',
            'Nama_Kurir'=>'required',
        ]);

        $inputPesanan = InputPesanan::findOrFail($id);
        $inputPesanan->update($request->all());

        return response()->json(['message' => 'Data Berhasil Di Ubah', 'Data' => $id, $inputPesanan], 200);
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
