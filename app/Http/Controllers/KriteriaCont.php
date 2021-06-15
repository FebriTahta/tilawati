<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Kriteria;
use DataTables;
use Illuminate\Http\Request;

class KriteriaCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.kriteria.index');
    }

    public function kriteria_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Kriteria::all();
            return DataTables::of($data)
            ->make(true);
        }
    }

    public function kriteria_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('kriterias')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('kriterias')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
