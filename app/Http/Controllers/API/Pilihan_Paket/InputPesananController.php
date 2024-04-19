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
            // Menggunakan manual aja (gk jadi pake loading pusing we ) untuk mengambil data Riwayat,
            $inputPesanan = InputPesanan::with('pilihanPaketByNama', 'pilihanPaketByHarga', 'kurir')
                                        ->where('nama', $user->nama)
                                        ->get();

            return response()->json($inputPesanan);
        } else {
            return response()->json(['message' => false]);
        }
    }
    public function riwayatpesananbyid($id)
    {   
        $user = Auth::user();
    
        if ($user){
            // Menggunakan manual aja (gk jadi pake loading pusing we ) untuk mengambil data Riwayat,
            $inputPesanan = InputPesanan::with('pilihanPaketByNama', 'pilihanPaketByHarga', 'kurir')
                                        ->where('nama', $user->nama)
                                        ->where('id', $id)
                                        ->first();
    
            if (!$inputPesanan) {
                return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
            }
    
            return response()->json($inputPesanan);
        } else {
            return response()->json(['message' => false], 401);
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
            'status',
            'paket',
            'paket_sekarang',
            'penerimaan_paket',
            'alamat'
        ]);

        $validatedData['nama'] = $user->nama;
        $validatedData['alamat'] = $user->alamat;
        $inputPesanan = InputPesanan::create($validatedData);

        // Load data kurir terkait dengan pesanan yang baru dibuat
        $inputPesanan->load('kurir');

        return response()->json(['message' => 'Data Berhasil Ditambahkan', 'data' => $inputPesanan], 200);
    }

    public function show(InputPesanan $inputPesanan)
    {
        // Menggunakan model load = loading untuk mengambil data pilihan paket terkait dengan pesanan !
        $inputPesanan->load('pilihanPaketByNama', 'pilihanPaketByHarga' , 'kurir');
        
        return response()->json($inputPesanan);
    }

    public function update(Request $request, $id)
    {
        $inputPesanan = InputPesanan::find($id);

        if (!$inputPesanan) {
            return response()->json([
                'message' => 'Pesanan tidak ditemukan',
                'success' => false
            ], 404);
        }

        $request->validate([
            'status',
            'paket',
            #kurir
            'paket_sekarang',
            'Alamat_Tujuan',
            'penerimaan_paket',
        ]);

        $inputPesanan->update($request->only(['status','paket', 'paket_sekarang','Alamat_Tujuan','penerimaan_paket']));
        return response()->json([
            'message' => 'Data Berhasil Diupdate',
            'data' => $inputPesanan,
            'success' => true
        ], 200);
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
