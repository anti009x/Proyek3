<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestDiagnosaController extends Controller
{
    public function index(){
        return view("upload.upload");
    }
}
