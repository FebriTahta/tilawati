<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cabang;
use Validator;
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
                    if ($data->user !== null) {
                        # code...
                        return $data->user->username;
                    }else {
                        # code...
                        return 'kosong';
                    }
                    
                })
                ->addColumn('pass', function ($data) {
                    if ($data->user !== null) {
                        return $data->user->pass;
                    }else {
                        return 'kosong';
                    }
                    
                })
                ->addColumn('opsi', function ($data) {
                    if ($data->user !== null) {
                        # code...
                        return '<a href="#" type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#modal-edit" data-id="'.$data->user_id.'" data-username="'.$data->user->username.'" data-pass="'.$data->user->pass.'"> Ubah Data</a>';
                    }else {
                        # code...
                        return 'kosong';
                    }
                    
                })
                ->rawColumns(['kota','cabang','opsi'])
                ->make(true);
        }
    }

    public function daftar_pengguna(Request $request)
    {
        
        $daftar_user_yang_memiliki_cabang = User::whereHas('cabang')->select('id')->get()->toArray();
        // Hapus semua user yang bukan bagian dari cabang dan bukan admin;
        if ($daftar_user_yang_memiliki_cabang !== null) {
            # code...
            $user_tak_terpakai =  User::where('username','!=','admin')->whereNotIn('id', $daftar_user_yang_memiliki_cabang)->delete();
        }
        $cabang_tanpa_user = Cabang::whereNotIn('user_id', $daftar_user_yang_memiliki_cabang)->get();
        return view('tilawatipusat.user.index',compact('cabang_tanpa_user'));
    }

    public function buat_user_baru(Request $request)
    {
        if ($request->cabang_id !== null) {
            # code...
            $validator = Validator::make($request->all(),
            [
                'cabang_id'=> 'required',
                'username' => 'required',
                'pass' => 'required',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'=> 400,
                    'message' => $validator->messages(),
                ]);
            }else {
                # code...
                $user = User::create(
                    [
                    'username' => strtolower($request->username),
                    'role' => 'cabang',
                    'pass'=> strtolower($request->pass),
                    'password'=> Hash::make($request->pass)
                ]);

                Cabang::findOrFail($request->cabang_id)->update(['user_id', $user->id]);

                return response()->json([
                    'status'=> 200,
                    'message' => 'user baru berhasil ditambahkan',
                ]);
            }


        }else {
            # code...
            return response()->json([
                'status' => 400,
                'message' => ['maaf tidak ditemukan cabang yang belum memiliki password. Tambahkan cabang terlebih dahulu']
            ]);
        }
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
        $cabang = Cabang::get();
        // User::where('username','!=','admin')->delete();
        foreach ($cabang as $key => $value) {
            # code...
            $pool = '0123456789';
            $acak = substr(str_shuffle(str_repeat($pool, 5)), 0, 3);

            if ($value->teritorial !== null) {
                # code...
                if ($value->teritorial == 'surabaya' || $value->teritorial == 'gresik' || $value->teritorial == 'Surabaya' || $value->teritorial == 'Gresik') {
                    # code...
                    User::updateOrCreate(
                        [
                            'id' => $value->user_id, 
                        ],[
                        'username' => 'tilawati '.strtolower($value->name),
                        'role' => 'cabang',
                        'pass'=> 'cab'.$acak,
                        'password'=>Hash::make('cab'.$acak)
                    ]);

                }else {
                    # code...
                    User::updateOrCreate(
                        [
                            'id' => $value->user_id, 
                        ],[
                        'username' => 'tilawati '.strtolower($value->teritorial),
                        'role' => 'cabang',
                        'pass'=> 'cab'.$acak,
                        'password'=>Hash::make('cab'.$acak)
                    ]);
                }
            }else {
                # code...
                User::updateOrCreate(
                    [
                        'id' => $value->user_id, 
                    ],[
                    'username' => 'tilawati '.strtolower($value->name),
                    'role' => 'cabang',
                    'pass'=> 'cab'.$acak,
                    'password'=>Hash::make('cab'.$acak)
                ]);
            }    
        }

        return redirect()->back();
        
    }
}
