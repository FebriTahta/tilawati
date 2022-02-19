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
                ->addColumn('opsi', function ($data) {
                    return '<a href="#" type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#modal-edit" data-id="'.$data->user_id.'" data-username="'.$data->user->username.'" data-pass="'.$data->user->pass.'"> Ubah Data</a>';
                })
                ->rawColumns(['kota','cabang','opsi'])
                ->make(true);
        }
    }

    public function daftar_pengguna(Request $request)
    {
        return view('tilawatipusat.user.index');
    }

    public function ganti_pass(Request $request)
    {
        if (auth()->user()->role == 'pusat') {
            # code...
            $data = User::where('id',$request->id)->first();
            $data->update([
                'username' => $request->username,
                'pass'=> $request->pass,
                'password'=>Hash::make($request->pass)
            ]);

            return response()->json(
                [
                  'success' => 'User Data Upto Date!',
                  'message' => 'User Data Upto Date!'
                ]
            );
        }
    }

    public function reset_password(Request $request)
    {
        $hapus = User::where('role', 'lembaga')->delete();
        
        $cabang = Cabang::orderBy('id','asc')->get();
        foreach ($cabang as $key => $value) {
            # code...
            if ($value->teritorial !== null) {
                # code...
                $pool = '0123456789';
                $acak = substr(str_shuffle(str_repeat($pool, 5)), 0, 3);
                if ($value->teritorial == 'surabaya' || $value->teritorial == 'gresik' || $value->teritorial == 'Surabaya' || $value->teritorial == 'Gresik') {
                    # code...
                    $value->user->update([
                        'username' => 'tilawati '.strtolower($value->name),
                        'pass'=> 'cab'.$acak,
                        'password'=>Hash::make('cab'.$acak)
                    ]);
                }else {
                    # code...
                    $value->user->update([
                        'username' => 'tilawati '.strtolower($value->teritorial),
                        'pass'=> 'cab'.$acak,
                        'password'=>Hash::make('cab'.$acak)
                    ]);
                }
            }    
        }

        
        // foreach ($user as $key => $value) {
        //     # code...
        //     $pool = '0123456789';
        //     $acak = substr(str_shuffle(str_repeat($pool, 5)), 0, 3);
        //     $value->update([
        //         'username' => 'tilawati '.$value->cabang->teritorial,
        //         'pass'=> 'cab'.$acak,
        //         'password'=>Hash::make('cab'.$acak)
        //     ]);
        // }


        // foreach ($user as $key => $value) {
        //     # code...
        //         $pool = '0123456789';
        //         $acak = substr(str_shuffle(str_repeat($pool, 5)), 0, 3);
        //         // if ($value->where('pass', 'cab'.$acak)->exists()) {
        //             # code...
        //             $pool2 = '0123456789';
        //             $acak2 = substr(str_shuffle(str_repeat($pool2, 5)), 0, 3);
        //             foreach ($value->cabang as $key => $values) {
        //                 # code...
        //                 if ($values->teritorial == 'surabaya' || $values->teritorial == 'gresik' || $values->teritorial == null) {
        //                     # code...
        //                     $values->update([
        //                         'username' => 'tilawati '.$values->name,
        //                         'pass'=> 'cab'.$acak2,
        //                         'password'=>Hash::make('cab'.$acak2)
        //                     ]);
        //                 } else {
        //                     # code...
        //                     $value->update([
        //                         'username' => 'tilawati '.$values->teritorial,
        //                         'pass'=> $values->teritorial.'cab'.$acak2,
        //                         'password'=>Hash::make($values->teritorial.'cab'.$acak2)
        //                     ]);
        //                 }
        //             }
                    
        //         // }else {
        //         //     # code...
        //         //     if ($value->cabang->teritorial == 'surabaya' || $value->cabang->teritorial == 'gresik' || $value->cabang->teritorial == null) {
        //         //         $value->update([
        //         //             'username' => 'tilawati '.$value->cabang->name,
        //         //             'pass'=> 'cab'.$acak,
        //         //             'password'=>Hash::make('cab'.$acak)
        //         //         ]);
        //         //     }else {
        //         //         # code...
        //         //         $value->update([
        //         //             'username' => 'tilawati '.$value->cabang->teritorial,
        //         //             'pass'=> $value->cabang->teritorial.'cab'.$acak,
        //         //             'password'=>Hash::make($value->cabang->teritorial.'cab'.$acak)
        //         //         ]);
        //         //     }
        //         // }
            
        // }

        return redirect()->back();
        
    }
}
