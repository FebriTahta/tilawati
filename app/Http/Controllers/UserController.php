<?php

namespace App\Http\Controllers;
use App\Models\User;
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
            $data = User::orderBy('id','asc');
                // return Datatables::of($data)
                //         ->addIndexColumn()
                //         ->addColumn('relasi', function(User $usr){
                //             if ($usr->cabang !== null) {
                //                 # code...
                //                 $rel = 'cabang';
                //             } elseif($usr->lembaga !== null){
                //                 $rel = 'lembaga';
                //             }
                //             return $rel;
                //         })
                //         ->rawColumns(['relasi'])
                //         ->make(true);
                return datatables()->of($data)->make(true);
        }
    }
}
