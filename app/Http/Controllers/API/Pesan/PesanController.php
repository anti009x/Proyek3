<?php

namespace App\Http\Controllers\API\Pesan;

use App\Http\Controllers\Controller;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Pusher\Pusher;

class PesanController extends Controller
{
    public function index(){

    }

    public function siaran(Request $request){
        broadcast(new PusherBroadcaster($request->get('pusher')))->toOthers();
        return response()->json([
            'pusher' => $request->get('pusher')
        ]);
    }
    public function penerima(Request $request){
        return response()->json([
            'pusher' => $request->get('pusher')
        ]);
    }

}
