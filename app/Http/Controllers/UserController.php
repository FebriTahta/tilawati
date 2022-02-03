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
            $data   = User::where('role','cabang');
                return DataTables::of($data)
                ->addColumn('kota', function ($data) {
                    return $data->cabang->kabupaten->nama;
                })
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name;
                })
                ->rawColumns(['kota','cabang'])
                ->make(true);
        }
    }

    public function daftar_pengguna(Request $request)
    {
        return view('tilawatipusat.user.index');
    }
}
