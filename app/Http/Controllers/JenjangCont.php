<?php

namespace App\Http\Controllers;
use DB;
Use App\Models\Jenjang;
use DataTables;
use Illuminate\Http\Request;

class JenjangCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.jenjang.index');
    }

    public function jenjang_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Jenjang::all();
            return DataTables::of($data)
            ->make(true);
        }
    }

    public function jenjang_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('jenjangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('jenjangs')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
