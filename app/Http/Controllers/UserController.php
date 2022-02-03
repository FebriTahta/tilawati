<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cabang;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function reset_password(Request $request)
    {
        $user = User::where('role','cabang')->get();
        $length = 3;
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
        
        foreach ($user as $key => $value) {
            # code...
            $value->update([
                'pass'=> 'cab'.$randomString,
                'password'=>Hash::make('cab'.$randomString)
            ]);
        }

        return redirect()->back();
    }
}
