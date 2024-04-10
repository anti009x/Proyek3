<?php

namespace App\Http\Controllers\API\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
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
