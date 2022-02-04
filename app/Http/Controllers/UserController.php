<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cabang;
use DataTables;
use Illuminate\Http\Request;
use Auth;
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

            $data = Cabang::with(['user','kabupaten']);
                return DataTables::of($data)
                ->addColumn('kota', function ($data) {
                    return $data->kabupaten->nama;
                })
                ->addColumn('username', function ($data) {
                    return $data->user->username;
                })
                ->addColumn('pass', function ($data) {
                    return $data->user->pass;
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
        foreach ($user as $key => $value) {
            # code...
            $pool = '0123456789';
            $acak = substr(str_shuffle(str_repeat($pool, 5)), 0, 3);
            if ($value->where('pass', 'cab'.$acak)->exists()) {
                # code...
                $pool2 = '0123456789';
                $acak2 = substr(str_shuffle(str_repeat($pool2, 5)), 0, 3);
                $value->update([
                    'username' => 'cabang'.$acak,
                    'pass'=> 'cab'.$acak2,
                    'password'=>Hash::make('cab'.$acak2)
                ]);
            }else {
                # code...
                $value->update([
                    'username' => 'cabang'.$acak,
                    'pass'=> 'cab'.$acak,
                    'password'=>Hash::make('cab'.$acak)
                ]);
            }
            
        }

        return redirect()->back();
        
    }
}
