<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index (Request $request){
        return view('MainDashboard.Admin.Login.login');
    }

    public function login (Request $request):RedirectResponse{
        $errors = 'Error';
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $auth->getAuthIdentifier();
            if ($auth->role_id === 1) {
                return redirect('dashboard')->with('success', 'Login successful');
            } else {
                return redirect('login')->with('error', 'Unauthorized access');
            }
        } else {
            return redirect('login')->with('error', $errors);
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('login')->with('success');
    }
}
