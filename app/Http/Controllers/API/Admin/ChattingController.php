<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChattingController extends Controller
{
    public function index()
    {
        

       

        return view('MainDashboard.LandingPage.chatting');
    }

    public function sendMessage(Request $request)
    {
        $antarin = 'Apa Itu Antar In?';
        $fungsiantarin = 'Apa Fungsi Antar In?';

        if (request()->input('antarin') == $antarin) {
            $antarin = request()->input('antarin');
            $antarin = '
            Adalah layanan yang memudahkan anda untuk mengirimkan barang ke tempat tujuan anda dengan mudah dan cepat.
            ';
        }else{
            $antarin = 'Maaf, saya tidak mengerti pertanyaan anda.';
        }

        // if (request()->input('antarin') == $fungsiantarin) {
        //     $antarin = request()->input('antarin');
        //     $antarin = '
        //     Layanan pengiriman ekpedisi yang menghadirkan berbagai macam pilihan dalam proses pengenaggutan
        //     ';
        // }else{
        //     $antarin = 'Maaf, saya tidak mengerti pertanyaan anda.';
        // }




        return response()->json(['message' => $antarin]);
    }
}
