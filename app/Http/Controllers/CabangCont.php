<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Cabang;
use App\Models\Munaqisy;
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
use Validator;
use Auth;
use File;
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
                        return $stats;
                    })
                    ->make(true);
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
                        return $stats;
                    })
                    ->make(true);
    }

    public function show_list_trainer_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            $data   = Trainer::where('cabang_id',$cabang_id)->with('cabang')->orderBy('id','asc');
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
    
}
