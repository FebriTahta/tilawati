<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Lembaga;
use App\Models\Cabang;
use App\Models\Jenjang;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class lembagaCont extends Controller
{
    public function index(Request $request)
    {
        $cabang = Cabang::all();
        $kabupaten = Kabupaten::all();
        $jenjang = Jenjang::all();
        return view('tilawatipusat.lembaga.index',compact('cabang','kabupaten','jenjang'));
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
                        $kepala = '<button class="btn btn-sm badge badge-danger" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">Kosong</button>';
                    } else {
                        # code...
                        $kepala ='<a href="#" data-toggle="modal"
                        data-target=".bs-example-modal-kepala-lembaga" data-kode="'.$data->kode.'">'. $data->kepala->name.'</a>';
                    }
                    return $kepala;
                })
                ->addColumn('kabupaten', function ($data) {
                    return $kabupaten = $data->kabupaten->nama;
                })
                ->addColumn('provinsi', function ($data) {
                    return $provinsi = $data->provinsi->nama;
                })
                ->addColumn('statuss', function ($data) {
                    if ($data->status == 'Aktif') {
                        # code...
                        $btn = '<span class="badge badge-success btn text-white">Aktif</span>';
                        return $btn;
                    } else {
                        # code...
                        $btn = '<span class="badge badge-danger btn text-white">Non Aktif</span>';
                        return $btn;
                    }
                    
                })
            ->rawColumns(['kepala','kabupaten','provinsi','statuss'])
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

    public function store(Request $request)
    {
        //create_user
        $username_baru      = $request->name;
        $dt_usr             = new User;
        $dt_usr->username   = $username_baru;
        $dt_usr->email      = $request->email;
        $dt_usr->password   = Hash::make('lembaga_nf');
        $dt_usr->role       = 'lembaga';
        $dt_usr->created_at = new \DateTime;
        $dt_usr->save();
        $kab = Kabupaten::where('id', $request->kabupaten)->first();
        $pro = $kab->provinsi_id;
        $kode = mt_rand(100000, 999999);
        
        $cek_kode_lembaga    = Lembaga::where('kode', $kode)->first();
        if ($cek_kode_lembaga == null) {
            # code...
            Lembaga::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'kode'          => $kode,
                    'user_id'       => $dt_usr->id,
                    'cabang_id'     => $request->cabang_id,
                    'jenjang_id'    => $request->jenjang_id,
                    'provinsi_id'   => $pro,
                    'kabupaten_id'  => $request->kabupaten,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'name'          => $request->name,
                    'telp'          => $request->telp,
                    'website'       => $request->website,
                    'daerah'        => substr($kab, 5),
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'pengelola'     => $request->pengelola,
                    'jml_guru'      => $request->jml_guru,
                    'jml_santri'    => $request->jml_santri,
                    'tahunmasuk'    => $request->tahunmasuk,
                    'status'        => 'Aktif',
                ]
            );
        } else {
            # code...
            $kode2  = mt_rand(100000, 999999);
            Lembaga::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'kode'          => $kode2,
                    'user_id'       => $dt_usr->id,
                    'cabang_id'     => $request->cabang_id,
                    'jenjang_id'    => $request->jenjang_id,
                    'provinsi_id'   => $pro,
                    'kabupaten_id'  => $request->kabupaten,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'name'          => $request->name,
                    'telp'          => $request->telp,
                    'website'       => $request->website,
                    'daerah'        => substr($kab, 5),
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'pengelola'     => $request->pengelola,
                    'jml_guru'      => $request->jml_guru,
                    'jml_santri'    => $request->jml_santri,
                    'tahunmasuk'    => $request->tahunmasuk,
                    'status'        => 'Aktif',
                ]
            );
        }
      
        return response()->json(
            [
              'success' => 'Lembaga Baru Berhasil Ditambahkan!',
              'message' => 'Lembaga Baru Berhasil Ditambahkan!'
            ]
        );
    }
}
