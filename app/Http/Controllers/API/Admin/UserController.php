<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function admin()
    {
        $User = User::paginate(5); 


        if ($User) {
            $User = User::where('role_id', 1)->paginate(5);
            return view('admin.user.admin', ['User' => $User]);
        }
    }
    public function userData(Request $request)
    {
        $query = User::query();

        if ($request->filled('nama') || $request->filled('email') || $request->filled('query')) {
            $query->where('role_id', 2);

            if ($request->filled('nama')) {
                $query->where('nama', 'like', '%' . $request->input('nama') . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->input('email') . '%');
            }
        } else {
            $query->whereNull('id'); 
            return redirect()->route('pengguna');
        }

        $users = $query->paginate(5);

        if ($request->wantsJson()) {
            return response()->json($users);
        }

        return view('MainDashboard.Admin.DataAkun.table_konsumen', ['User' => $users]);
    }

    


    public function index()
    {
        return view('MainDashboard.Admin.DataAkun.server_status');
    }



    public function konsumen()
    {
        $User = User::paginate(5); 


        if ($User) {
            $User = User::where('role_id', 2)->paginate(5);
            return view('MainDashboard.Admin.DataAkun.table_konsumen', ['User' => $User]);
        }
    }

    public function kurir()
    {
        $User = User::paginate(5); 


        if ($User) {
            $User = User::where('role_id', 3)->paginate(5);
            return view('admin.user.konsumen', ['User' => $User]);
        }
    }

    public function delete($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $User->update($request->all());
        return redirect()->back();
    }

    public function store(Request $request){
        $ValidateData = $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role_id'=>'required',
            'nohp'=>'required',
            'alamat'=>'required',
        ]);

        $User = User::create($ValidateData);

        $User ->save();

        return redirect()->back();
    }   
}
