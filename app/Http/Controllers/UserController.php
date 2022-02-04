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

        // $characters = '0123456789abcdefghiklmnopqrstuvwxyz';
        // $charactersNumber = strlen($characters);
        // $codeLength = 3;

        // $code = '';

        // while (strlen($code) < 3) {
        //     $position = rand(0, $charactersNumber - 1);
        //     $character = $characters[$position];
        //     $code = 'cab'.$code.$character;
        // }

        // $data = User::where('role','cabang')->get();
        // foreach ($data as $key => $value) {
        //     # code...
        //     if ($value::where('pass', $code)->exists()) {
        //         // $this->generateUniqueCode();
        //         while (strlen($code) < 3) {
        //             $position = rand(0, $charactersNumber - 1);
        //             $character = $characters[$position];
        //             $code = 'cab'.$code.$character;
        //         }
        //         $value->update([
        //                     'pass'=> $code,
        //                     'password'=>Hash::make($code)
        //                 ]);
        //     }else {
        //         # code...
        //         $value->update([
        //             'pass'=> $code,
        //             'password'=>Hash::make($code)
        //         ]);
        //     }
        // }

        
    }
}
