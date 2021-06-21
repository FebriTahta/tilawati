<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Cabang;
use DataTables;
use Illuminate\Http\Request;

class CabangCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.cabang.index');
    }

    public function cabang_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Cabang::with('provinsi','kabupaten','kepala');
            return DataTables::of($data)
            ->addColumn('provinsi', function ($data) {
                return $data->provinsi->nama;
            })
            ->addColumn('kabupaten', function ($data) {
                return $data->kabupaten->nama;
            })
            ->addColumn('kepala', function($data){
                return $data->kepala->name;
            })
            ->rawColumns(['provinsi','kabupaten','kepala'])
            ->make(true);
        }
    }

    public function cabang_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('cabangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('cabangs')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function cabang_kabupaten(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('cabangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('cabangs')
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function cabang_provinsi(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('cabangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->select('provinsi_id', DB::raw('count(*) as total'))
                ->groupBy('provinsi_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('cabangs')
                ->select('provinsi_id', DB::raw('count(*) as total'))
                ->groupBy('provinsi_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
