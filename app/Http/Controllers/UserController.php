<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cabang;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $dt_usr = User::all();
        return view('AdmPelatihan.User.index',compact('dt_usr'));
    }

    public function getuser_data(Request $request)
    {
        if(request()->ajax())
        {
            $data = User::orderBy('username','asc')->with('cabang');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('kota', function(User $usr){
                            return $data->cabang->kabupaten->nama;
                        })
                        ->addIndexColumn()
                        ->addColumn('cabang', function(User $usr){
                            return $data->cabang->name;
                        })
                        ->rawColumns(['kota'])
                        ->make(true);
        }
    }

    public function daftar_pengguna(Request $request)
    {
        return view('tilawatipusat.user.index');
    }
}
