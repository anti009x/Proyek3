<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilihanPaket;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $PilihanPaket = PilihanPaket::paginate(5); 
        return view('admin.pesanan', ['PilihanPaket' => $PilihanPaket]);
    }
    public function delete($id)
    {
        $PilihanPaket = PilihanPaket::findOrFail($id);
        $PilihanPaket->delete();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $PilihanPaket = PilihanPaket::findOrFail($id);
        $PilihanPaket->update($request->all());
        return redirect()->back();
    }

    public function store(Request $request){
        $ValidateData = $request->validate([
            'Nama_Paket'=>'required',
            'Harga_Paket'=>'required',
        ]);

        $PilihanPaket = PilihanPaket::create($ValidateData);

        $PilihanPaket ->save();

        return redirect()->back();
    }   
}


