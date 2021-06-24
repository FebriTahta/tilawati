<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Lembaga;
use DataTables;
use Illuminate\Http\Request;

class lembagaCont extends Controller
{
    public function index(Request $request)
    {
        
        return view('tilawatipusat.lembaga.index');
    }

    public function lembaga_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Lembaga::orderBy('tahunmasuk','desc')->with(['kepala','provinsi','kabupaten'])
            ->select(['kode','name','kepala_id','kabupaten_id','provinsi_id','telp','jml_guru','jml_santri','alamat','tahunmasuk','status']);
            return DataTables::of($data)
                ->addColumn('kepala', function($data){
                    if ($data->kepala == null) {
                        # code...
                        $kepala = '<span class="btn btn-sm badge badge-danger" data-toggle="modal"
                        data-target="#tambah_kepala">Kosong</span>';
                    } else {
                        # code...
                        $kepala = $data->kepala->name;
                    }
                    return $kepala;
                })
                ->addColumn('kabupaten', function ($data) {
                    return $kabupaten = $data->kabupaten->nama;
                })
                ->addColumn('provinsi', function ($data) {
                    return $provinsi = $data->provinsi->nama;
                })                   
            ->rawColumns(['kepala','kabupaten','provinsi'])
            ->make(true);
        }
    }

    public function lembaga_aktif(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_nonaktif(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('status', 'Non Aktif')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')->where('status', 'Non Aktif')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_kabupaten(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_provinsi(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->select('provinsi_id', DB::raw('count(*) as total'))
                ->groupBy('provinsi_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')
                ->select('provinsi_id', DB::raw('count(*) as total'))
                ->groupBy('provinsi_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
