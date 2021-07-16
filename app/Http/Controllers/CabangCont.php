<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Cabang;
use App\Models\Provinsi;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class CabangCont extends Controller
{
    public function index(Request $request)
    {
        $dt_props2 = Provinsi::all();
        return view('tilawatipusat.cabang.index',compact('dt_props2'));
    }

    public function store(Request $request)
    {
        $username_baru      = $request->name;
        $dt_usr             = new User;
        $dt_usr->username   = $username_baru;
        $dt_usr->email      = $request->email;
        $dt_usr->password   = Hash::make('cabang_nf');
        $dt_usr->role       = 'cabang';
        $dt_usr->created_at = new \DateTime;
        $dt_usr->save();
        $kode = mt_rand(100000, 999999);
        
        $cek_kode_cabang    = Cabang::where('kode', $kode)->first();
        if ($cek_kode_cabang == null) {
            # code...
            Cabang::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'kode'          => $kode,
                    'user_id'       => $dt_usr->id,
                    'name'          => $username_baru,
                    'status'        => $request->status,
                    'provinsi_id'   => $request->provinsi_id,
                    'kabupaten_id'  => $request->kabupaten_id,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'telp'          => $request->telp,
                    'ekspedisi'     => $request->ekspedisi,
                ]
            );
        } else {
            # code...
            $kode2  = mt_rand(100000, 999999);
            Cabang::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'kode'          => $kode2,
                    'user_id'       => $dt_usr->id,
                    'name'          => $username_baru,
                    'status'        => $request->status,
                    'provinsi_id'   => $request->provinsi_id,
                    'kabupaten_id'  => $request->kabupaten_id,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'telp'          => $request->telp,
                    'ekspedisi'     => $request->ekspedisi,
                ]
            );
        }

        return response()->json(
            [
              'success' => 'Cabang Baru Berhasil Ditambahkan!',
              'message' => 'Cabang Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function cabang_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Cabang::with('provinsi','kabupaten','kepala')->orderBy('id','desc')
                ->whereBetween('created_at', array($request->dari, $request->sampai));
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
                        $kepala ='<a href="#" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">'. $data->kepala->name.'</a>';
                    }else{
                        $kepala = '<button class="btn btn-sm badge badge-danger" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">Kosong</button>';
                    }
                    return $kepala;
                })
                ->rawColumns(['provinsi','kabupaten','kepala'])
                ->make(true);
            }else{
                $data   = Cabang::with('provinsi','kabupaten','kepala')->orderBy('id','desc');
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    if ($data->provinsi == null) {
                        # code...
                    } else {
                        # code...
                        return $data->provinsi->nama;
                    }
                    
                    
                })
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten == null) {
                        # code...
                    } else {
                        # code...
                        return $data->kabupaten->nama;
                    }
                })
                ->addColumn('kepala', function($data){
                    if ($data->kepala !== null) {
                        # code...
                        $kepala ='<a href="#" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">'. $data->kepala->name.'</a>';
                    }else{
                        $kepala = '<button class="btn btn-sm badge badge-danger" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">Kosong</button>';
                    }
                    return $kepala;
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
