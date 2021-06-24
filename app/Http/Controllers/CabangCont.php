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
            if(!empty($request->dari))
            {
                $data   = Cabang::with('provinsi','kabupaten','kepala')
                ->whereBetween('created_at', array($request->dari, $request->sampai));;
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('kabupaten', function ($data) {
                    return $data->kabupaten->nama;
                })
                ->addColumn('kepala', function($data){
                    if ($data->kepala !== null) {
                        # code...
                        return $data->kepala->name;
                    }
                })
                ->rawColumns(['provinsi','kabupaten','kepala'])
                ->make(true);
            }else{
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

    public function data_cabang_provinsi(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Cabang::with('provinsi')
                ->whereBetween('created_at', array($request->dari, $request->sampai))->select('provinsi_id')->distinct();
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="btn btn-sm btn-info" data-dismiss="modal" data-toggle="modal" data-target="#mod_cabang3" data-id="'.$data->provinsi->id.'"> check </button>';
                    return $btn;
                })
                ->rawColumns(['provinsi','action'])
                ->make(true);
            }else{
                $data   = Cabang::with('provinsi')->select('provinsi_id')->distinct();
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info" data-dismiss="modal" data-toggle="modal" data-target="#mod_cabang3" data-id="'.$data->provinsi->id.'"> check </a>';
                    return $btn;
                })
                ->rawColumns(['provinsi','action'])
                ->make(true);
            }
        }
    }

    public function data_cabang_provinsi_view(Request $request, $id, $tanggal){
        
        $data   = Cabang::with('provinsi','kabupaten','kepala')->where('provinsi_id', $prov_id)
                ->whereBetween('created_at', array($request->dari, $request->sampai))->get();
        return view('tilawatipusat.cabang.provinsi_view',compact('data'));
    }

    public function data_cabang_provinsi_data(Request $request, $prov_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Cabang::with('provinsi','kabupaten','kepala')->where('provinsi_id', $prov_id)
                ->whereBetween('created_at', array($request->dari, $request->sampai));
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="btn btn-sm btn-info" data-nama="'.$data->provinsi->id.'"> check </button>';
                    return $btn;
                })
                ->rawColumns(['provinsi','action'])
                ->make(true);
            }else{
                $data   = Cabang::with('provinsi','kabupaten','kepala')->where('provinsi_id', $prov_id);
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<button class="btn btn-sm btn-info" data-nama="'.$data->provinsi->id.'"> check </button>';
                    return $btn;
                })
                ->rawColumns(['provinsi','action'])
                ->make(true);
            }
        }
    }

}
