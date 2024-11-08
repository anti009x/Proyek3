<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index (){
        return view('MainDashboard.LandingPage.Landing');
        // return view('admin.layouts.sidebar');
        // return view('admin.layouts.topbar');
        // return view('admin.layouts.content');
        // return view('admin.layouts.footer');
    }
    public function profile (){
        return view('MainDashboard.Admin.AdminProfile.admin_profile');
    }
}
