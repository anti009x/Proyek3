<?php

namespace App\Http\Controllers\API\Diagnosa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TestDiagnosaController extends Controller
{
    public function index(){
        return view("upload.upload");
        
    }
}
