<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Cabang;
use App\Models\Munaqisy;
use App\Models\Syirkah;
use App\Models\Kepala;
use App\Models\Provinsi;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Macamtrainer;
use App\Models\macamtrainer_trainer;
use App\Models\Kpa;
use App\Models\Supervisor;
use App\Models\Penguruscabang;
use Validator;
use \Carbon\Carbon;
use App\Models\Peserta;
use Auth;
use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CabangCont extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role == 'cabang') {
            # code...
            $cabang_id = auth()->user()->cabang->id;
            $dt_props2 = Provinsi::all();
            $pengurus_kepala = Penguruscabang::where('cabang_id', $cabang_id)->where('bagian','Kepala Cabang')->first();
            $kabid_admin = Penguruscabang::where('cabang_id', $cabang_id)->where('bagian','Kabid Administrasi, Keuangan & Disardik')->first();
            $kabid_diklat = Penguruscabang::where('cabang_id', $cabang_id)->where('bagian','Kabid Diklat & Munaqosyah')->first();
            $kabid_lembaga = Penguruscabang::where('cabang_id', $cabang_id)->where('bagian','Kabid Pengembangan Kelembagaan')->first();
            $kabid_super = Penguruscabang::where('cabang_id',$cabang_id)->where('bagian','Kabid Supervisor')->first();
            return view('tilawatipusat.cabang.index',compact('dt_props2','pengurus_kepala','kabid_admin','kabid_diklat','kabid_lembaga','kabid_super'));
        }else {
            # code...
            $dt_props2 = Provinsi::all();
            return view('tilawatipusat.cabang.index',compact('dt_props2'));
        }
       
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
                    'kadivre'       => $request->kadivre,
                    'teritorial'    => $request->teritorial,
                    'kepalacabang'  => $request->kepalacabang,
                    'pos'           => $request->pos,
                    'telp'          => $request->telp,
                    'ekspedisi'     => $request->ekspedisi,
                    // 'email'         => $request->email,
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
                    'kadivre'       => $request->kadivre,
                    'teritorial'    => $request->teritorial,
                    'kepalacabang'  => $request->kepalacabang,
                    'alamat'        => $request->alamat,
                    'pos'           => $request->pos,
                    'telp'          => $request->telp,
                    'ekspedisi'     => $request->ekspedisi,
                    // 'email'         => $request->email,
                ]
            );
        }

        return response()->json(
            [
            //   'success' => 'Cabang Baru Berhasil Ditambahkan!',
            'success' => 'Sukses!',
              'message' => 'Sukses!'
            //   'message' => 'Cabang Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function update_cabang(Request $request)
    {
        Cabang::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name'          => $request->name,
                'status'        => $request->status,
                'alamat'        => $request->alamat,
                'kadivre'       => $request->kadivre,
                'teritorial'    => $request->teritorial,
                'kepalacabang'  => $request->kepalacabang,
                'pos'           => $request->pos,
                'telp'          => $request->telp,
                'ekspedisi'     => $request->ekspedisi,
                // 'email'         => $request->email,
            ]
        );

        return response()->json(
            [
            //   'success' => 'Cabang Baru Berhasil Ditambahkan!',
            'success' => 'Sukses!',
              'message' => 'Sukses!'
            //   'message' => 'Cabang Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function cabang_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Cabang::orderBy('id','DESC')->whereBetween('created_at', array($request->dari, $request->sampai))->with('provinsi','kabupaten','kpa','trainer');
                return DataTables::of($data)
                ->addColumn('provinsi', function ($data) {
                    return $data->provinsi->nama;
                })
                ->addColumn('kabupaten', function ($data) {
                    return $data->kabupaten->nama;
                })
                ->addColumn('total_kpa', function ($data) {
                    if ($data->kpa->count() > 0) {
                        # code...
                        return '<a href="#" data-toggle="modal" data-target="#modalkpa" data-id="'.$data->id.'" data-cabang_name="'.$data->name .'">'.$data->kpa->count().' KPA</a>';
                    }else {
                        # code...
                        return "-";
                    }
                    
                })
                ->addColumn('trainers', function ($data) {

                    if ($data->trainer->count() > 0) {
                        # code...
                        
                        return '<a href="#" data-toggle="modal" data-target="#modaltrainer" data-cabang_id="'.$data->id.'">'.Trainer::where('cabang_id', $data->id)->count().' Trainer</a>';
                    } else {
                        # code...
                        return ' - ';
                    }
                    
                })
               
                ->addColumn('opsi', function ($data){
                    // $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                    // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                    if (auth()->user()->role=='pusat') {
                        # code...
                        $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                        data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                        data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                        data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                        $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                        return $btn;
                    }else {
                        # code...
                        if (auth()->user()->cabang->id == $data->id) {
                            # code...
                            $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                            data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                            data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                            data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                            // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                            return $btn;
                        }else {
                            # code...
                            return '<span style="color:red">Fitur Pusat</span>';
                        }
                        
                    }
                })
                ->addColumn('tot_lembaga', function ($data){
                    if ($data->lembaga->count() > 0) {
                        # code...
                        return '<a href="" data-toggle="modal" data-target="#modallembaga" data-download="/export-template-lembaga/'.$data->id.'" data-cabang_id="'.$data->id.'" data-cabang_name="'.$data->name .'">'.$data->lembaga->count().' - LEMBAGA</a>';
                        
                    }else {
                        # code...
                        return '-';
                    }
                })

                ->addColumn('location', function ($data){
                    if ($data->lng == null && $data->lat == null) {
                        # code...
                        return '<a href="#" class="text-danger" data-toggle="modal" data-target="#modallocation" data-id="'.$data->id.'" data-cabang_name="'.$data->name .'" data-lng="'.$data->lng.'" data-lat="'.$data->lat.'">Kosong</a>';
                        
                    }else {
                        # code...
                        return '<a href="#" class="text-success" data-toggle="modal" data-target="#modallocation" data-id="'.$data->id.'" data-cabang_name="'.$data->name .'" data-lng="'.$data->lng.'" data-lat="'.$data->lat.'">Ready On Map</a>';
                    }
                })
                ->rawColumns(['provinsi','kabupaten','total_kpa','trainer','opsi','tot_lembaga','location'])
                ->make(true);
            }else{
                $data   = Cabang::orderBy('created_at','DESC')->with('provinsi','kabupaten','kpa','trainer');
                return DataTables::of($data)
                
                ->addColumn('provinsi', function ($data) {
                    if ($data->provinsi == null) {
                        # code...
                    } else {
                        # code...
                        return $data->provinsi->nama;
                    }
                })
                ->addColumn('total_kpa', function ($data) {
                    if ($data->kpa->count() > 0) {
                        # code...
                        return '<a href="#" data-download="/export-template-kpa-data/'.$data->id.'" data-toggle="modal" data-target="#modalkpa" data-cabang_id="'.$data->id.'" data-cabang_name="'.$data->name .'">'.$data->kpa->count().' KPA</a>';
                    }else {
                        # code...
                        return "-";
                    }
                })
                ->addColumn('tot_lembaga', function ($data){
                    if ($data->lembaga->count() > 0) {
                        # code...
                        return '<a href="" data-toggle="modal" data-target="#modallembaga" data-download="/export-template-lembaga/'.$data->id.'" data-cabang_id="'.$data->id.'" data-cabang_name="'.$data->name .'">'.$data->lembaga->count().' - LEMBAGA</a>';
                        
                    }else {
                        # code...
                        return '-';
                    }
                })
                ->addColumn('trainers', function ($data) {

                    
                    if ($data->trainer->count() > 0) {
                        # code...
                       
                        return '<a href="#" data-download="/export-template-trainer-data/'.$data->id.'" data-toggle="modal" data-cabang_name="'.$data->name.'" data-target="#modaltrainer" data-cabang_id="'.$data->id.'">'.Trainer::where('cabang_id', $data->id)->count().' Trainer</a>';
                    } else {
                        # code...
                        return ' - ';
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
                
                ->addColumn('opsi', function ($data){
                    // $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                    // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                    if (auth()->user()->role=='pusat') {
                        # code...
                        $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                        data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                        data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                        data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                        $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                        return $btn;
                    }else {
                        # code...
                        if (auth()->user()->cabang->id == $data->id) {
                            # code...
                            $btn = '<a href="#" data-toggle="modal" data-target="#modal-cabang2" data-id="'.$data->id.'" data-name="'.$data->name.'" data-alamat="'.$data->alamat.'" 
                            data-kadivre="'.$data->kadivre.'" data-teritorial="'.$data->teritorial.'" data-telp="'.$data->telp.'" 
                            data-email="'.$data->email.'" data-status="'.$data->status.'" data-kepalacabang="'.$data->kepalacabang.'"
                            data-kabupaten="'.$data->kabupaten_id.'" data-provinsi="'.$data->provinsi_id.'" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Update!</a>';
                            // $btn .= ' <a href="#" class="btn btn-sm btn-outline-danger" data-id="'.$data->id.'" data-user_id="'.$data->user_id.'" data-toggle="modal" data-target="#modal-hapus"><i class="fa fa-trash"></i></a>'; 
                            return $btn;
                        }else {
                            # code...
                            return '<span style="color:red">Fitur Pusat</span>';
                        }
                        
                    }
                })

                ->addColumn('location', function ($data){
                    if ($data->lng == null && $data->lat == null) {
                        # code...
                        return '<a href="#" class="text-danger" data-toggle="modal" data-target="#modallocation" data-id="'.$data->id.'" data-cabang_name="'.$data->name .'" data-lng="'.$data->lng.'" data-lat="'.$data->lat.'">Kosong</a>';
                        
                    }else {
                        # code...
                        return '<a href="#" class="text-success" data-toggle="modal" data-target="#modallocation" data-id="'.$data->id.'" data-cabang_name="'.$data->name .'" data-lng="'.$data->lng.'" data-lat="'.$data->lat.'">Ready On Map</a>';
                    }
                })
                ->rawColumns(['provinsi','kabupaten','total_kpa','trainers','opsi','tot_lembaga','location'])
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

    public function data_trainer(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        $cabang = Cabang::where('id',$cabang_id)->select('id','name','kabupaten_id')->with('kabupaten')->first();
        return view('tilawatipusat.cabang.trainer',compact('cabang'));
    }

    public function list_trainer_cabang(Request $request)
    {
        if(request()->ajax())
        {
            $cabang_id  = auth()->user()->cabang->id;
            $data   = Trainer::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
                    return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $stats = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus" data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        $stats .= ' <a href="/edit-trainer/cabang/'.$data->id.'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                        return $stats;
                    })
                    ->addColumn('trains', function ($data) {
                        $x=[];
                        foreach ($data->macamtrainer as $key => $value) {
                            # code...
                            $x[] =$value->jenis;
                        }
                        return implode("<br>", $x);
                        
                    })
                    ->rawColumns(['action','trains'])
                    ->make(true);
        }
    }

    public function list_munaqisy_cabang(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
            $data   = Munaqisy::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
                    return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $stats = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus" data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        $stats .= ' <a href="#" data-toggle="modal" data-target="#modal-add" data-name="'.$data->name.'" data-telp="'.$data->telp.'" data-id="'.$data->id.'"
                        data-alamat="'.$data->alamat.'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                        return $stats;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function store_munaqisy_cabang(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        $data = Munaqisy::where('cabang_id',$cabang_id)->updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'cabang_id' => $cabang_id,
                'name' => $request->name,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
            ]
        );

        return response()->json(
            [
                'status'=> 200,
                'message' => 'Munaqisy Cabang has been Updated'
            ]
        );
    }

    public function remove_munaqisy_cabang(Request $request)
    {
        $data = Munaqisy::where('cabang_id', auth()->user()->cabang->id)->where('id', $request->id)->first();
        if ($data !== null) {
            # code...
            $data->delete();
            return response()->json(
                [
                    'status'=> 200,
                    'message'=> 'Munaqisy has been deleted',
                ]
            );
        }else {
            # code...
            return response()->json(
                [
                    'status'=> 400,
                    'message'=> 'Undefined',
                ]
            );
        }
    }

    public function store_supervisor_cabang(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        $data = Supervisor::where('cabang_id',$cabang_id)->updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'cabang_id' => $cabang_id,
                'name' => $request->name,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
            ]
        );

        return response()->json(
            [
                'status'=> 200,
                'message' => 'Supervisor Cabang has been Updated'
            ]
        );
    }

    public function remove_supervisor_cabang(Request $request)
    {
        $data = Supervisor::where('cabang_id', auth()->user()->cabang->id)->where('id', $request->id)->first();
        if ($data !== null) {
            # code...
            $data->delete();
            return response()->json(
                [
                    'status'=> 200,
                    'message'=> 'Supervisor has been deleted',
                ]
            );
        }else {
            # code...
            return response()->json(
                [
                    'status'=> 400,
                    'message'=> 'Undefined',
                ]
            );
        }
    }

    public function remove_supervisor($cabang_id)
    {
        $data = Supervisor::where('cabang_id',$cabang_id)->delete();
        return redirect()->back();
    }

    public function remove_munaqisy($cabang_id)
    {
        $data = Munaqisy::where('cabang_id',$cabang_id)->delete();
        return redirect()->back();
       
    }

    public function ya()
    {
        return 'oke';
    }

    public function list_supervisor_cabang(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
            $data   = Supervisor::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
                    return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $stats = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus" data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        $stats .= ' <a href="#" data-toggle="modal" data-target="#modal-add" data-name="'.$data->name.'" data-telp="'.$data->telp.'" data-id="'.$data->id.'"
                        data-alamat="'.$data->alamat.'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                        return $stats;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function show_list_trainer_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            $data   = Trainer::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','desc');
                    return DataTables::of($data)
                    ->addColumn('trains', function ($data) {
                        $x=[];
                        foreach ($data->macamtrainer as $key => $value) {
                            # code...
                            $x[] =$value->jenis;
                        }
                        return implode("<br>", $x);
                        
                    })
                    ->rawColumns(['trains'])
                    ->make(true);
        }
    }

    public function edit_trainer($trainer_id)
    {
        $macam = Macamtrainer::all();
        $trainer = Trainer::where('id',$trainer_id)->first();
        return view('tilawatipusat.cabang.trainer_update',compact('trainer','macam'));
    }

    public function store_trainer_cabang(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        $trainer = Trainer::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'cabang_id' => $cabang_id,
                'name'      => $request->name,
                'trainer'   => $request->trainer,
                'status'    => 'aktif',
                'telp'      => $request->telp,
                'alamat'    => $request->alamat,
            ]
        );

        if ($request->stats !== null) {
            # code...
            if ($request->stats == 'Munaqisy') {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 3;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }else {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                $ok_trainer->created_at = new \DateTime;
                $ok_trainer->macamtrainer_id = 4;
                $ok_trainer->trainer_id = $trainer->id;
                $ok_trainer->save();
            }
            
        }else {
            # code...
            if ($request->macamtrainer_id[1] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 1;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
            if ($request->macamtrainer_id[2] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 2;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
        }

        
        // if ($request->macamtrainer_id[3] !== null) {
        //     # code...
        //     $ok_trainer = new macamtrainer_trainer;
        //         $ok_trainer->created_at = new \DateTime;
        //         $ok_trainer->macamtrainer_id = 3;
        //         $ok_trainer->trainer_id = $trainer->id;
        //         $ok_trainer->save();
        // }
        // if ($request->macamtrainer_id[4] !== null) {
        //     # code...
        //     $ok_trainer = new macamtrainer_trainer;
        //         $ok_trainer->created_at = new \DateTime;
        //         $ok_trainer->macamtrainer_id = 4;
        //         $ok_trainer->trainer_id = $trainer->id;
        //         $ok_trainer->save();
        // }

        

        return response()->json(
            [
              'success' => 'Trainer Baru Berhasil Ditambahkan!',
              'message' => 'Trainer Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function store_location_cabang(Request $request)
    {
        if (auth()->user()->role == 'cabang') {
            # code...
            return response()->json(
                [
                  'success' => 'Maaf Anda Tidak Berhak Mengubah / Menambahkan Lokasi Cabang',
                  'message' => 'Maaf Anda Tidak Berhak Mengubah / Menambahkan Lokasi Cabang'
                ]
            );
        }else {
            # code...
            $location = Cabang::find($request->id)->update(
                [
                    'lng' => $request->lng,
                    'lat' => $request->lat,
                ]
            );
            return response()->json(
                [
                  'success' => 'Lokasi Cabang Tersebut Berhasil Diperbarui',
                  'message' => 'Lokasi Cabang Tersebut Berhasil Diperbarui'
                ]
            );
        }
    }



    public function delete_trainer_cabang(Request $request)
    {
        $id = $request->id;
        Trainer::find($id)->delete();
        macamtrainer_trainer::where('trainer_id', $id)->delete();
        return response()->json(
            [
              'success' => 'Trainer Dihapus!',
              'message' => 'Trainer Dihapus!'
            ]
        );
    }

    public function update_data_trainer(Request $request)
    {
        $trainer = Trainer::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'cabang_id' => $request->cabang_id,
                'name'        => $request->name,
                'telp'        => $request->telp,
                'alamat'        => $request->alamat
            ]
        );
        macamtrainer_trainer::where('trainer_id', $request->id)->delete();

        foreach ($request->status as $key => $value) {
            # code...
            $ok_trainer = new macamtrainer_trainer;
                $ok_trainer->created_at = new \DateTime;
                $ok_trainer->macamtrainer_id = $value;
                $ok_trainer->trainer_id = $trainer->id;
                $ok_trainer->save();
        }

        return response()->json(
            [
              'success' => 'OK!',
              'message' => 'OK!'
            ]
        );
    }

    public function add_data_trainer(Request $request)
    {
        if (auth()->user()->role == 'cabang') {
            # code...
            $trainer = Trainer::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'cabang_id' => auth()->user()->cabang->id,
                    'name'        => $request->name,
                    'telp'        => $request->telp,
                    'alamat'        => $request->alamat
                ]
            );
    
            if ($request->macamtrainer_id[1] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 1;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
            if ($request->macamtrainer_id[2] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 2;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
            if ($request->macamtrainer_id[3] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 3;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
            if ($request->macamtrainer_id[4] !== null) {
                # code...
                $ok_trainer = new macamtrainer_trainer;
                    $ok_trainer->created_at = new \DateTime;
                    $ok_trainer->macamtrainer_id = 4;
                    $ok_trainer->trainer_id = $trainer->id;
                    $ok_trainer->save();
            }
    
            return response()->json(
                [
                  'success' => 'OK!',
                  'message' => 'OK!'
                ]
            );
        }else {
            # code...
            return response()->json(
                [
                  'success' => 'harus cabang!',
                  'message' => 'harus cabang!'
                ]
            );
        }
        
    }

    public function data_kpa(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        if(request()->ajax())
        {
            # code...
            $data   = Kpa::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
                    return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $stats = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus" data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        $stats .= ' <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add" data-id="'.$data->id.'" data-name="'.$data->name.'"
                        data-telp="'.$data->telp.'" data-wilayah="'.$data->wilayah.'" data-ketua="'.$data->ketua.'"><i class="fa fa-edit"></i></a>';
                        return $stats;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        $kpa = Kpa::where('cabang_id',$cabang_id)->with('cabang')->first();
        $cabang = Cabang::where('id',$cabang_id)->select('id','name','kabupaten_id')->with('kabupaten')->first();
        return view('tilawatipusat.cabang.kpa',compact('kpa','cabang'));
    }

    public function show_data_kpa(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            # code...
            $data   = Kpa::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
                    return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $stats = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus" data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        $stats .= ' <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add" data-id="'.$data->id.'" data-name="'.$data->name.'"
                        data-telp="'.$data->telp.'" data-wilayah="'.$data->wilayah.'" data-ketua="'.$data->ketua.'"><i class="fa fa-edit"></i></a>';
                        return $stats;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
    }

    public function store_kpa_cabang(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        Kpa::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'cabang_id' => $cabang_id,
                'name'      => $request->name,
                'ketua'   => $request->ketua,
                'wilayah'    => $request->wilayah,
                'telp'      => $request->telp,
            ]
        );

        return response()->json(
            [
              'success' => 'KPA Baru Berhasil Ditambahkan!',
              'message' => 'KPA Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete_kpa_cabang(Request $request)
    {
        $id = $request->id;
        Kpa::find($id)->delete();

        return response()->json(
            [
              'success' => 'KPA Dihapus!',
              'message' => 'KPA Dihapus!'
            ]
        );
    }

    public function generate_kepala()
    {
        $cabang = Cabang::all();
        foreach ($cabang as $key => $value) {
            # code...
            $value->update([
                'kepalacabang'=>$value->kepala->name
            ]);
        }

        return redirect()->back();
    }

    public function cabang_hapus(Request $request)
    {
        $data = Cabang::where('id', $request->id)->first();
        $user = User::where('id', $data->user_id)->delete();
        Cabang::where('id', $data->id)->delete();
        return response()->json(
            [
              'success' => 'Cabang Berhasil Dihapus!',
              'message' => 'Cabang Berhasil Dihapus!'
            ]
        );
    }

    public function urut_cabang(Request $request)
    {
        $data = Cabang::orderBy('created_at','asc')->get();
       
        foreach ($data as $key => $value) {
            # code...
            $value->update(
                [
                    'kode' => $key+1
                ]
            );
        }

        return redirect()->back();
    }

    public function data_munaqisy(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        $cabang = Cabang::where('id',$cabang_id)->select('id','name','kabupaten_id')->with('kabupaten')->first();
        return view('tilawatipusat.cabang.munaqisy',compact('cabang'));
    }

    public function data_supervisor(Request $request)
    {
        $cabang_id  = auth()->user()->cabang->id;
        $cabang = Cabang::where('id',$cabang_id)->select('id','name','kabupaten_id')->with('kabupaten')->first();
        return view('tilawatipusat.cabang.supervisor',compact('cabang'));
    }

    public function upload_ttd(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $validator = Validator::make($request->all(), [
                'imageposting.*'    => 'image|mimes:png|max:4096'
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => 400,
                    'message'  => 'Response Gagal'.$validator->messages(),
                ]);
    
            }else {
                if($request->hasFile('ttd') && auth()->user()->role == 'cabang' || auth()->user()->role == 'pusat'){ 

                    # code...
                    $ekstensi   = $request->ttd->extension();

                    $filename   = time().'.'.$request->ttd->getClientOriginalExtension();
                    $request->file('ttd')->move('img_ttd/',$filename);
                    $data       = Cabang::where('id', auth()->user()->cabang->id)->update(
                        [
                            'ttd' => $filename,
                            'status_ttd' => 'menunggu'
                        ]
                    );

                    return response()->json(
                        [
                          'status'  => 200,
                          'message' => 'Upload File Berhasil'
                        ]
                    );

                     

                }else {
                    # code...
                    return response()->json(
                        [
                          'status'  => 400,
                          'message' => 'undefined file upload'
                        ]
                    );

                }
            }

        }
    }

    public function upload_ttd_ulang(Request $request){

        if ($request->ajax()) {
            # code...
            $validator = Validator::make($request->all(), [
                'imageposting.*'    => 'image|mimes:png|max:4096'
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => 400,
                    'message'  => 'Response Gagal'.$validator->messages(),
                ]);
    
            }else {
                if($request->hasFile('ttd') && auth()->user()->role == 'cabang' || auth()->user()->role == 'pusat'){ 

                    $cabang = Cabang::where('id', auth()->user()->cabang->id)->first();
                    if(File::exists(public_path("img_ttd/".$cabang->ttd))){
                       File::delete(public_path("img_ttd/".$cabang->ttd));
                    }
                    # code...
                    $ekstensi   = $request->ttd->extension();

                    $filename   = time().'.'.$request->ttd->getClientOriginalExtension();
                    $request->file('ttd')->move('img_ttd/',$filename);
                    $data       = Cabang::where('id', auth()->user()->cabang->id)->update(
                        [
                            'ttd' => $filename,
                            'status_ttd' => 'menunggu'
                        ]
                    );

                    return response()->json(
                        [
                          'status'  => 200,
                          'message' => 'Upload File Berhasil'
                        ]
                    );

                }else {
                    # code...
                    return response()->json(
                        [
                          'status'  => 400,
                          'message' => 'undefined file upload'
                        ]
                    );

                }
            }

        }
    }

    public function pengurus_cabang_post(Request $request) 
    {
        $cabang_id = auth()->user()->cabang->id;
        $cabang = Cabang::where('id', $cabang_id)->first();
        
        if ($request->namapengurus[0] !== null) {
            # code...
            $cabang->update(['kepalacabang' => $request->namapengurus[0]]);
        }

        $data_nama = $request->namapengurus;
        $data_telp = $request->telppengurus;
        $bagian    = $request->bagian;
        $pengurusId  = $request->id;

        for ($i=0; $i < count($data_nama); $i++) { 
            # code...
            
            $datas = Penguruscabang::where('cabang_id', auth()->user()->cabang->id)
            ->updateOrCreate(
                [
                    'id' => $pengurusId[$i]
                ],
                [
                    'cabang_id' => $cabang_id,
                    'bagian' => $bagian[$i],
                    'nama_pengurus' => $data_nama[$i],
                    'telp_pengurus' => $data_telp[$i],
                    
                ]
            );
            
        }

        return response()->json([
            'status' => 200,
            'message' => 'Pengurus Cabang has been Updated'
        ]);
    }

    public function daftar_peserta_cabang_keseluruhan(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        if ($request->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                # code...
                $data = Peserta::where('cabang_id', $cabang_id)->with(['pelatihan','program'])->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
                })
                ->addColumn('program', function($data){
                    $program = $data->program->name;
                    return ucwords($program);
                })
                ->addColumn('pelatihan', function($data){
                    $tanggal = Carbon::parse($data->pelatihan->tanggal)->format('d F Y');
                    return ucwords($tanggal);
                })
                ->addColumn('ttl', function($data){
                    # code...
                    // return $data->tgllahir;
                    if ($data->tmptlahir !== null && $data->tgllahir !== null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }else {
                            # code...
                            return  $data->tmptlahir.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }
                    }

                    if ($data->tmptlahir == null && $data->tgllahir !== null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }else {
                            # code...
                            return  '<a href="#" style="color:red" data-toggle="modal" data-target="#addkota2" data-id ="'.$data->id.'"> Kosong / Salah Penulisan</a>' .' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }
                    }

                    if ($data->tmptlahir !== null && $data->tgllahir == null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }else {
                            # code...
                            return  $data->tmptlahir.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }
                        
                    }

                    if ($data->tmptlahir == null && $data->tgllahir == null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl">Tgl Salah Format</a>';
                        }else {
                            # code...
                            return  '<a href="" style="color:red" data-id ="'.$data->id.'"  data-toggle="modal" data-target="#addkota3"> Kosong / Salah Penulisan</a>' .' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }
                    }
                })
                ->addColumn('opsi', function($data){
                    $ke_data_pelatihan = '<a href="/diklat-peserta/'.$data->pelatihan->id.'" class="btn btn-primary"><i class="fa fa-forward"></i></a>';
                    return $ke_data_pelatihan;
                })
                ->rawColumns(['program','pelatihan','ttl','check','opsi'])
                ->make(true);

            }else {
                # code...
                $data = Peserta::where('cabang_id', $cabang_id)->with(['pelatihan','program']);
                return DataTables::of($data)
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="sub_chk" data-id="'.$data->id.'">';
                })
                ->addColumn('program', function($data){
                    $program = $data->program->name;
                    return ucwords($program);
                })
                ->addColumn('pelatihan', function($data){
                    $tanggal = Carbon::parse($data->pelatihan->tanggal)->format('d F Y');
                    return ucwords($tanggal);
                })
                ->addColumn('ttl', function($data){
                    # code...
                    // return $data->tgllahir;
                    if ($data->tmptlahir !== null && $data->tgllahir !== null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }else {
                            # code...
                            return  $data->tmptlahir.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }
                    }

                    if ($data->tmptlahir == null && $data->tgllahir !== null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }else {
                            # code...
                            return  '<a href="#" style="color:red" data-toggle="modal" data-target="#addkota2" data-id ="'.$data->id.'"> Kosong / Salah Penulisan</a>' .' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                        }
                    }

                    if ($data->tmptlahir !== null && $data->tgllahir == null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }else {
                            # code...
                            return  $data->tmptlahir.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }
                        
                    }

                    if ($data->tmptlahir == null && $data->tgllahir == null) {
                        # code...
                        if ($data->tmptlahir2 !== null) {
                            # code...
                            return  $data->tmptlahir2.' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl">Tgl Salah Format</a>';
                        }else {
                            # code...
                            return  '<a href="" style="color:red" data-id ="'.$data->id.'"  data-toggle="modal" data-target="#addkota3"> Kosong / Salah Penulisan</a>' .' - '.'<a style="color:red" href="#" data-toggle="modal" data-target="#addtgl" data-id ="'.$data->id.'">Tgl Salah Format</a>';
                        }
                    }
                })
                ->addColumn('opsi', function($data){
                    $ke_data_pelatihan = '<a href="/diklat-peserta/'.$data->pelatihan->id.'" class="btn btn-primary"><i class="fa fa-forward"></i></a>';
                    return $ke_data_pelatihan;
                })
                ->rawColumns(['program','pelatihan','ttl','check','opsi'])
                ->make(true);
            }
           

        }
        
        return view('tilawatipusat.cabang.mypeserta');
    }

    public function status_peserta_cabang(Request $request)
    {
        if ($request->ajax()) {
            # code...
            if (!empty($request->dari)) {
                # code...
                $cabang_id = auth()->user()->cabang->id;
                $semua = Peserta::where('cabang_id', $cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $lulus = Peserta::where('cabang_id', $cabang_id)->where('bersyahadah', 1)->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $tidak = 0;
                if ($semua > 0) {
                    # code...
                    $tidak = $semua - $lulus;
                }

                return response()->json(
                    [
                        'status' => 200,
                        'semua' => $semua,
                        'lulus' => $lulus,
                        'tidak' => $tidak,
                    ]
                );
            }else {
                # code...
                $cabang_id = auth()->user()->cabang->id;
                $semua = Peserta::where('cabang_id', $cabang_id)->count();
                $lulus = Peserta::where('cabang_id', $cabang_id)->where('bersyahadah', 1)->count();
                $tidak = 0;
                if ($semua > 0) {
                    # code...
                    $tidak = $semua - $lulus;
                }

                return response()->json(
                    [
                        'status' => 200,
                        'semua' => $semua,
                        'lulus' => $lulus,
                        'tidak' => $tidak,
                    ]
                );
            }
        }
    }

    public function get_wilayah_cabang($cabang_id)
    {
        $data = Cabang::where('id', $cabang_id)->first();
        return response()->json(
            [
                'status'=> 200,
                'data'  => $data->teritorial." - ".$data->kadivre,
            ]
        );
    }

    public function upload_dokumen_syirkah(Request $request)
    {
        if ($request->ajax()) {
            if($request->hasFile('file')) {
                # code...
                $extension = $request->file('file')->extension();
                if ($extension == 'pdf') {
                    # code...
                    $validator = Validator::make($request->all(), [
                        'imageposting.*'    => 'required|mimes:pdf|max:10000'
                    ]);
    
                    if ($validator->fails()) {
                        # code...
                        return response()->json(
                            [
                                'status' => 400,
                                'message'=> $validator->messages(),
                            ]
                        );
                    }else {
                        # code...
    
                        if ($request->id !== null) {
                            # code...
                            $exist = Syirkah::findOrFail($request->id);
                            if ($exist) {
                                # code...
                                if(File::exists(public_path('syirkah_dc/'.$exist->syirkah_dc)))
                                {
                                    File::delete(public_path('syirkah_dc/'.$exist->syirkah_dc));
                                }
                            }
                        }
    
    
                        $extension = $request->file('file')->extension();
                        $filename    = time().'.'.Str::slug(strtolower(substr($request->file->getClientOriginalName(),0,-3))).'.'.$extension;
                        $request->file('file')->move('syirkah_dc/',$filename);
    
                        $data = Syirkah::updateOrCreate(
                            [
                                'id' => $request->id,
                            ],
                            [
                                'cabang_id'=> $request->cabang_id,
                                'ekstensi' => $extension,
                                'syirkah_dc' => $filename,
                            ]
                        );
    
                        return response()->json([
                            'status' => 200,
                            'message' => 'Dokumen Syirkah '.$extension.' berhasil disimpan'
                        ]);
                    }
                }else {
                    # code...
                    return response()->json(
                        [
                            'status' => 400,
                            'message'=> ['Sistem hanya menerima file PDF untuk dokumen syirkah'],
                        ]
                    );
                }
                
            }else {
                # code...
                return response()->json(
                    [
                        'status' => 400,
                        'message'=> ['Syirkah harus berupa dokumen PDF tidak boleh kosong'],
                    ]
                );
            }
        }
    }

    public function remove_dokumen_syirkah(Request $request)
    {
        if ($request->ajax()) {
            $exist = Syirkah::findOrFail($request->id);
            if ($exist) {
                # code...
                if(File::exists(public_path('syirkah_dc/'.$exist->syirkah_dc)))
                {
                    File::delete(public_path('syirkah_dc/'.$exist->syirkah_dc));
                    $exist->delete();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Dokumen Syirkah telah dihapus'
                    ]);
                }else {
                    # code...
                    return response()->json([
                        'status' => 200,
                        'message' => 'Syirkah Telah dihapus tanpa ada dokumen didalamnya'
                    ]);
                }
            }else {
                # code...
                return response()->json(
                    [
                        'status' => 400,
                        'message'=> ['Dokumen Syirkah Tidak Ditemukan'],
                    ]
                );
            }
        }
    }
}
