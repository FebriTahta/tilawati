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

    public function lembaga_data_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            $data   = Lembaga::where('cabang_id', $cabang_id);
            return DataTables::of($data)
                
                ->addColumn('statuss', function ($data) {
                    if ($data->status == 'Aktif' || $data->status == 'aktif' || $data->status == ' aktif' || $data->status == 'aktif ' || $data->status == ' Aktif' || $data->status == ' aktif ' || $data->status == ' Aktif ' || $data->status == 'Aktif ' ||
                    $data->status == 'AKTIF' || $data->status == ' AKTIF' || $data->status == 'AKTIF ' || $data->status == ' AKTIF ') {
                        # code...
                        $btn = '<span class="badge badge-success btn text-white">Aktif</span>';
                        return $btn;
                    } else {
                        # code...
                        $btn = '<span class="badge badge-danger btn text-white">Non Aktif</span>';
                        return $btn;
                    }
                    
                })
            ->rawColumns(['statuss'])
            ->make(true);
            
        }
    }

    public function lembaga_data(Request $request)
    {
        if(request()->ajax())
        {
            if(auth()->user()->role == 'cabang'){
                $data   = Lembaga::orderBy('id','asc')->where('cabang_id', auth()->user()->cabang->id)->with(['kepala','provinsi','kabupaten']);
                return DataTables::of($data)
                    ->addColumn('kepala', function($data){
                        
                        $kepala = $data->kepalalembaga;
                        return $kepala;
                    })
                    ->addColumn('kabupaten', function ($data) {
                        if ($data->kabupaten !== null) {
                            return substr($kabupaten = $data->kabupaten->nama,5);
                        }else{
                            return '<a href="#" data-toggle="modal" data-target="#addkota" data-id="'.$data->id.'" class="text-danger">kosong / salah penulisan </a>';
                        }
                    })
                    ->addColumn('provinsi', function ($data) {
                        if ($data->provinsi !== null) {
                            return $provinsi = $data->provinsi->nama;
                        }else{
                            return "-";
                        }
                    })
                    ->addColumn('statuss', function ($data) {
                        if ($data->status == 'Aktif' || $data->status == 'aktif' || $data->status == ' aktif' || $data->status == 'aktif ' || $data->status == ' Aktif' || $data->status == ' aktif ' || $data->status == ' Aktif ' || $data->status == 'Aktif ' ||
                    $data->status == 'AKTIF' || $data->status == ' AKTIF' || $data->status == 'AKTIF ' || $data->status == ' AKTIF ') {
                            # code...
                            $btn = '<span class="badge badge-success btn text-white">Aktif</span>';
                            return $btn;
                        } else {
                            # code...
                            $btn = '<span class="badge badge-danger btn text-white">Non Aktif</span>';
                            return $btn;
                        }
                        
                    })
                    ->addColumn('opsi', function ($data) {
                        $btn = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#modal-hapus" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>';
                        $btn .= ' <a href="#" data-toggle="modal" data-status="'.$data->status.'" data-id="'.$data->id.'" data-name="'.$data->name.'" data-kepala="'.$data->kepalalembaga.'" data-telp="'.$data->telp.'" data-kab="'.$data->kabupaten_id.'" data-guru="'.$data->jml_guru.'" data-santri="'.$data->jml_santri.'" data-alamat="'.$data->alamat.'" data-pengelola="'.$data->pengelola.'" data-status="'.$data->status.'" data-pos="'.$data->pos.'" data-email="'.$data->email.'" data-website="'.$data->website.'" data-jenjang="'.$data->jenjang.'" data-target="#modal-edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })
                ->rawColumns(['kepala','kabupaten','provinsi','statuss','opsi'])
                ->make(true);
            }else {
                # code...
                if(!empty($request->prov_id))
                {
                    # code...
                    $data   = Lembaga::orderBy('tahunmasuk','desc')->where('provinsi_id', $request->prov_id)->with(['kepala','provinsi','kabupaten']);
                    return DataTables::of($data)
                        ->addColumn('kepala', function($data){
                        
                            $kepala = $data->kepalalembaga;
                            return $kepala;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                return substr($kabupaten = $data->kabupaten->nama,5);
                            }else{
                                return '<a href="#" data-toggle="modal" data-target="#addkota" data-id="'.$data->id.'" class="text-danger">kosong / salah penulisan </a>';
                            }
                        })
                        ->addColumn('provinsi', function ($data) {
                            if ($data->provinsi !== null) {
                                return $provinsi = $data->provinsi->nama;
                            }else{
                                return "-";
                            }
                        })
                        ->addColumn('statuss', function ($data) {
                            if ($data->status == 'Aktif' || $data->status == 'aktif' || $data->status == ' aktif' || $data->status == 'aktif ' || $data->status == ' Aktif' || $data->status == ' aktif ' || $data->status == ' Aktif ' || $data->status == 'Aktif ' ||
                    $data->status == 'AKTIF' || $data->status == ' AKTIF' || $data->status == 'AKTIF ' || $data->status == ' AKTIF ') {
                                # code...
                                $btn = '<span class="badge badge-success btn text-white">Aktif</span>';
                                return $btn;
                            } else {
                                # code...
                                $btn = '<span class="badge badge-danger btn text-white">Non Aktif</span>';
                                return $btn;
                            }
                            
                        })
                        ->addColumn('opsi', function ($data) {
                            $btn = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#modal-hapus" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>';
                            $btn .= ' <a href="#" data-toggle="modal" data-status="'.$data->status.'" data-id="'.$data->id.'" data-name="'.$data->name.'" data-kepala="'.$data->kepalalembaga.'" data-telp="'.$data->telp.'" data-kab="'.$data->kabupaten_id.'" data-guru="'.$data->jml_guru.'" data-santri="'.$data->jml_santri.'" data-alamat="'.$data->alamat.'" data-pengelola="'.$data->pengelola.'" data-status="'.$data->status.'" data-pos="'.$data->pos.'" data-email="'.$data->email.'" data-website="'.$data->website.'" data-jenjang="'.$data->jenjang.'" data-target="#modal-edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>';
                            return $btn;
                            
                        })
                    ->rawColumns(['kepala','kabupaten','provinsi','statuss','opsi'])
                    ->make(true);

                }else {
                    # code...
                    $data   = Lembaga::orderBy('tahunmasuk','desc')->with(['kepala','provinsi','kabupaten']);
                    return DataTables::of($data)
                        ->addColumn('kepala', function($data){
                        
                            $kepala = $data->kepalalembaga;
                            return $kepala;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                return substr($kabupaten = $data->kabupaten->nama,5);
                            }else{
                                return '<a href="#" data-toggle="modal" data-target="#addkota" data-id="'.$data->id.'" class="text-danger">kosong / salah penulisan </a>';
                            }
                        })
                        ->addColumn('provinsi', function ($data) {
                            if ($data->provinsi !== null) {
                                return $provinsi = $data->provinsi->nama;
                            }else{
                                return "-";
                            }
                        })
                        ->addColumn('statuss', function ($data) {
                            if ($data->status == 'Aktif' || $data->status == 'aktif' || $data->status == ' aktif' || $data->status == 'aktif ' || $data->status == ' Aktif' || $data->status == ' aktif ' || $data->status == ' Aktif ' || $data->status == 'Aktif ' ||
                    $data->status == 'AKTIF' || $data->status == ' AKTIF' || $data->status == 'AKTIF ' || $data->status == ' AKTIF ') {
                                # code...
                                $btn = '<span class="badge badge-success btn text-white">Aktif</span>';
                                return $btn;
                            } else {
                                # code...
                                $btn = '<span class="badge badge-danger btn text-white">Non Aktif</span>';
                                return $btn;
                            }
                            
                        })
                        ->addColumn('opsi', function ($data) {
                            $btn = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#modal-hapus" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>';
                            $btn .= ' <a href="#" data-toggle="modal" data-status="'.$data->status.'" data-id="'.$data->id.'" data-name="'.$data->name.'" data-kepala="'.$data->kepalalembaga.'" data-telp="'.$data->telp.'" data-kab="'.$data->kabupaten_id.'" data-guru="'.$data->jml_guru.'" data-santri="'.$data->jml_santri.'" data-alamat="'.$data->alamat.'" data-pengelola="'.$data->pengelola.'" data-status="'.$data->status.'" data-pos="'.$data->pos.'" data-email="'.$data->email.'" data-website="'.$data->website.'" data-jenjang="'.$data->jenjang.'" data-target="#modal-edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>';
                            return $btn;
                            
                        })
                    ->rawColumns(['kepala','kabupaten','provinsi','statuss','opsi'])
                    ->make(true);
                }
            }
            
        }
    }

    public function lembaga_aktif(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')->orwhere('status', ' Aktif')->orwhere('status', 'Aktif ')->orwhere('status', ' Aktif ')
                ->orwhere('status', 'aktif')->orwhere('status', ' aktif')->orwhere('status', 'aktif ')->orwhere('status', ' aktif ')
                ->orwhere('status', 'AKTIF')->orwhere('status', ' AKTIF')->orwhere('status', 'AKTIF ')->orwhere('status', ' AKTIF ')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')->orwhere('status', ' Aktif')->orwhere('status', 'Aktif ')->orwhere('status', ' Aktif ')
                ->orwhere('status', 'aktif')->orwhere('status', ' aktif')->orwhere('status', 'aktif ')->orwhere('status', ' aktif ')
                ->orwhere('status', 'AKTIF')->orwhere('status', ' AKTIF')->orwhere('status', 'AKTIF ')->orwhere('status', ' AKTIF ')
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
                $data = DB::table('lembagas')->where('status', 'Aktif')->orwhere('status', ' Aktif')->orwhere('status', 'Aktif ')->orwhere('status', ' Aktif ')
                ->orwhere('status', 'aktif')->orwhere('status', ' aktif')->orwhere('status', 'aktif ')->orwhere('status', ' aktif ')
                ->orwhere('status', 'AKTIF')->orwhere('status', ' AKTIF')->orwhere('status', 'AKTIF ')->orwhere('status', ' AKTIF ')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $tot = DB::table('lembagas')->count();
                $akt = DB::table('lembagas')->where('status', 'Aktif')->orwhere('status', ' Aktif')->orwhere('status', 'Aktif ')->orwhere('status', ' Aktif ')
                ->orwhere('status', 'aktif')->orwhere('status', ' aktif')->orwhere('status', 'aktif ')->orwhere('status', ' aktif ')
                ->orwhere('status', 'AKTIF')->orwhere('status', ' AKTIF')->orwhere('status', 'AKTIF ')->orwhere('status', ' AKTIF ')->count();
                $data = $tot - $akt;
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

    public function lembaga_aktif2(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')->where('cabang_id',auth()->user()->cabang->id)
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')->where('status', 'Aktif')->where('cabang_id',auth()->user()->cabang->id)
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_nonaktif2(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('status', '!=', 'aktif')->orwhere('status', '!=', 'Aktif')->where('cabang_id',auth()->user()->cabang->id)
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $tot = DB::table('lembagas')->where('cabang_id',auth()->user()->cabang->id)->count();
                $akt = DB::table('lembagas')->where('status', 'Aktif')->where('cabang_id',auth()->user()->cabang->id)->count();
                $data = $tot - $akt;
                return response()->json($data,200);
            }
        }
    }

    public function lembaga_total2(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('lembagas')->where('cabang_id',auth()->user()->cabang->id)
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('lembagas')->where('cabang_id',auth()->user()->cabang->id)
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
        $kab = Kabupaten::where('id', $request->kabupaten_id)->first();
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
                    'kabupaten_id'  => $request->kabupaten_id,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'name'          => $request->name,
                    'kepalalembaga' => $request->kepalalembaga,
                    'telp'          => $request->telp,
                    'website'       => $request->website,
                    'daerah'        => substr($kab, 5),
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'pengelola'     => $request->pengelola,
                    'jml_guru'      => $request->jml_guru,
                    'jml_santri'    => $request->jml_santri,
                    'tahunmasuk'    => $request->tahunmasuk,
                    'email'         => $request->email,
                    'status'        => 'Aktif',
                    'jenjang'       => $request->jenjang,
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
                    'kabupaten_id'  => $request->kabupaten_id,
                    'kecamatan_id'  => $request->kecamatan_id,
                    'kelurahan_id'  => $request->kelurahan_id,
                    'name'          => $request->name,
                    'kepalalembaga' => $request->kepalalembaga,
                    'telp'          => $request->telp,
                    'website'       => $request->website,
                    'daerah'        => substr($kab, 5),
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'pengelola'     => $request->pengelola,
                    'jml_guru'      => $request->jml_guru,
                    'jml_santri'    => $request->jml_santri,
                    'tahunmasuk'    => $request->tahunmasuk,
                    'email'         => $request->email,
                    'status'        => 'Aktif',
                    'jenjang'       => $request->jenjang,
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

    public function lembaga_hapus(Request $request)
    {
        $data = Lembaga::where('id', $request->id)->delete();
        return response()->json(
            [
              'success' => 'Lembaga Berhasil Dihapus!',
              'message' => 'Lembaga Berhasil Dihapus!'
            ]
        );
    }

    public function store2(Request $request)
    {
        //create_user
        // $username_baru      = $request->name;
        // $dt_usr             = new User;
        // $dt_usr->username   = $username_baru;
        // $dt_usr->email      = $request->email;
        // $dt_usr->password   = Hash::make('lembaga_nf');
        // $dt_usr->role       = 'lembaga';
        // $dt_usr->created_at = new \DateTime;
        // $dt_usr->save();
        $kab = Kabupaten::where('id', $request->kabupaten_id)->first();
        $pro = $kab->provinsi_id;
        Lembaga::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                // 'jenjang_id'    => $request->jenjang_id,
                'provinsi_id'   => $pro,
                'kabupaten_id'  => $request->kabupaten_id,
                // 'kecamatan_id'  => $request->kecamatan_id,
                // 'kelurahan_id'  => $request->kelurahan_id,
                'name'          => $request->name,
                'kepalalembaga' => $request->kepalalembaga,
                'telp'          => $request->telp,
                'website'       => $request->website,
                'daerah'        => substr($kab->nama, 5),
                'alamat'        => $request->alamat,
                'pos'           => $request->pos,
                'pengelola'     => $request->pengelola,
                'jml_guru'      => $request->jml_guru,
                'jml_santri'    => $request->jml_santri,
                'tahunmasuk'    => $request->tahunmasuk,
                'status'        => $request->status,
                'email'         => $request->email,
                'jenjang'       => $request->jenjang,
            ]
        );
        
        
        
      
        return response()->json(
            [
              'success' => 'Lembaga Berhasil Diperbarui!',
              'message' => 'Lembaga Berhasil Diperbarui!'
            ]
        );
    }

    public function add_kota(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->id !== null) {
                # code...
                $id = $request->id;
                $kab_id = $request->sel_kab;
                $kab = Kabupaten::where('id', $kab_id)->first();
                $data = Lembaga::where('id',$id)->update([
                    'kabupaten_id' => $kab_id,
                    'provinsi_id' => $kab->provinsi_id
                ]);
                return response()->json(
                    [
                    'success' => 'Data Kota Peserta Berhasil Diperbarui',
                    'message' => 'Data Kota Peserta Berhasil Diperbarui'
                    ]
                );
            }else{
               
                return response()->json(
                    [
                    'error' => 'Jangan diurutkan berdasarkan kabupaten',
                    'message' => 'Tidak bisa merubah data apabila diurutkan berdasarkan kabupaten yang kosong'
                    ]
                );
            }
        }
    }

    public function hapus_semua($cabang_id)
    {
        Lembaga::where('cabang_id', $cabang_id)->delete();
        return redirect()->back();
    }
}
