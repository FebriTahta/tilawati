<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Program;
use App\Models\Peserta;
use DB;
use App\Models\Cabang;
use DataTables;
use Carbon\Carbon;
use File;
use App\Models\Flyer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WebinarCont extends Controller
{
    public function index(Request $request)
    {
        $dt_program = Program::all();
        return view('tilawatipusat.webinar.index',compact('dt_program'));
    }

    public function webinar_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('tanggal','desc')->where('jenis','webinar')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-diklat-link" 
                            data-slug="https://registrasi.tilawatipusat.com/'.$data->slug.'" >Link Pendaftaran!</a>';
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-diklat-hapus" data-id="'.$data->id.'" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></a> ';
                            $actionBtn.= ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-diklat-edit" data-id="'.$data->id.'" data-tanggal="'.$data->tanggal.'" data-cabang="'.$data->cabang_id.'"
                            data-program="'.$data->program_id.'" data-tempat="'.$data->tempat.'" data-keterangan="'.$data->keterangan.'" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-edit"></i></a>';
                            
                        })
                        ->addColumn('groupwa', function($data){
                            if ($data->groupwa == null) {
                                # code...
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-danger">Kosong</a>';
                            }else{
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('flyer', function($data){
                            if ($data->flyer == null) {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-flyer" class="text-danger">Kosong</a>';
                            }else {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-flyerid="'.$data->flyer->id.'" data-img="'.asset('image_flyer/'.$data->flyer->image).'" data-toggle="modal" data-target="#modal-flyer" class="text-success">Siap</a>';
                            }
                        })
                ->rawColumns(['cabang','program','action','peserta','linkpendaftaran','tanggal','flyer','groupwa'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('tanggal','desc')->where('jenis','webinar');
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                $jumlah_peserta = Peserta::where('pelatihan_id',$data->id)->where('status',1)->count();
                                if ($jumlah_peserta !== 0) {
                                    # code...
                                    return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-success">'.$jumlah_peserta.' - peserta <a>';
                                }else{
                                    return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-danger">'.$jumlah_peserta.' - peserta <a>';
                                }
                                
                                // return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-diklat-link" 
                            data-slug="https://registrasi.tilawatipusat.com/'.$data->slug.'" >Pendaftaran!</a>';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-diklat-hapus" data-id="'.$data->id.'" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></a> ';
                            $actionBtn.= ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-diklat-edit" data-id="'.$data->id.'" data-tanggal="'.$data->tanggal.'" data-cabang="'.$data->cabang_id.'"
                            data-program="'.$data->program_id.'" data-tempat="'.$data->tempat.'" data-keterangan="'.$data->keterangan.'" data-groupwa="'.$data->groupwa.'" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-edit"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                        ->addColumn('groupwa', function($data){
                            if ($data->groupwa == null) {
                                # code...
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-danger">Kosong</a>';
                            }else{
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('flyer', function($data){
                            if ($data->flyer == null) {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-flyer" class="text-danger">Kosong</a>';
                            }else {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-flyerid="'.$data->flyer->id.'" data-img="'.asset('image_flyer/'.$data->flyer->image).'" data-toggle="modal" data-target="#modal-flyer" class="text-success">Siap</a>';
                            }
                        })
                ->rawColumns(['cabang','groupwa','flyer','program','action','peserta','linkpendaftaran','tanggal'])
                ->make(true);
            }
        }
    }

    public function webinar_data_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::where('cabang_id',$cabang_id)->with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','webinar')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<span class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<span>';
                            } else {
                                # code...
                                return '<span class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="/diklat-peserta-webinar/'.$data->id.'" class="btn btn-sm btn-outline btn-success fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-webinar-hapus" data-id="'.$data->id.'" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            return $actionBtn;
                        })->addColumn('groupwa', function($data){
                            if ($data->groupwa == null) {
                                # code...
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-danger">Kosong</a>';
                            }else{
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('flyer', function($data){
                            if ($data->flyer == null) {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-flyer" class="text-danger">Kosong</a>';
                            }else {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-flyerid="'.$data->flyer->id.'" data-img="'.asset('image_flyer/'.$data->flyer->image).'" data-toggle="modal" data-target="#modal-flyer" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-webinar-link" 
                            data-slug="https://registrasi.tilawatipusat.com/'.$data->slug.'" >Link Pendaftaran!</a>';
                        })
                ->rawColumns(['cabang','tanggal','program','action','peserta','groupwa','flyer','linkpendaftaran'])
                ->make(true);
            }else{
                $data   = Pelatihan::where('cabang_id', $cabang_id)->with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','webinar');
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/diklat-peserta-webinar/'.$data->id.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="/diklat-peserta-webinar/'.$data->id.'" class="btn btn-sm btn-outline btn-success fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" data-toggle="modal" data-target=".bs-example-modal-webinar-hapus" data-id="'.$data->id.'" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('groupwa', function($data){
                            if ($data->groupwa == null) {
                                # code...
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-danger">Kosong</a>';
                            }else{
                                return '<a href="#" data-link="'.$data->groupwa.'" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-wa" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('flyer', function($data){
                            if ($data->flyer == null) {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-flyer" class="text-danger">Kosong</a>';
                            }else {
                                # code...
                                return '<a href="#" data-id="'.$data->id.'" data-flyerid="'.$data->flyer->id.'" data-img="'.asset('image_flyer/'.$data->flyer->image).'" data-toggle="modal" data-target="#modal-flyer" class="text-success">Siap</a>';
                            }
                        })
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-webinar-link" 
                            data-slug="https://registrasi.tilawatipusat.com/'.$data->slug.'" >Link Pendaftaran!</a>';
                        })
                        ->addColumn('tanggal', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                ->rawColumns(['cabang','tanggal','program','action','peserta','groupwa','flyer','linkpendaftaran'])
                ->make(true);
            }
        }
    }

    public function webinar_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')->where('jenis','webinar')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pelatihans')->where('jenis','webinar')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function webinar_cabang_select(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Cabang::select('id','name','kode')
            		->where('name','LIKE','%' .$search . '%')
                    ->orWhere('kode', 'LIKE', '%' .$search . '%')
            		->get();
        }else{
            $data = Cabang::select('id','name','kode')->get();
        }
        return response()->json($data);
    }

    public function webinar_cabang_select_id($name)
    {
        $data = Cabang::where('name', $name)->select('id')->first();
        return response()->json($data,200);
    }

    public function create(Request $request)
    {
        $dt_program = Program::all();
        return view('tilawatipusat.webinar.create',compact('dt_program'));
    }

    public function storeeditwa(Request $request)
    {
        $data   = Pelatihan::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'groupwa' => $request->groupwa
            ]
        );
        return response()->json(
            [
              'success' => 'Link Wa Baru Berhasil Ditambahkan',
              'message' => 'Link Wa Baru Berhasil Ditambahkan'
            ]
        );
    }

    public function storeflyer(Request $request)
    {
        $id             = $request->flyerid;
        $pelatihan_id   = $request->id;
        // ada
        // if ($id == null) {
            # code...
            if ($request->image !== null) {
                # code...
                $data2  = Flyer::updateOrCreate(
                    [
                        'id' => $id
                    ],
                    [
                        'pelatihan_id' => $pelatihan_id,
                        'image' => $request->image,
                    ]
                );
                if($request -> hasFile('image'))
                {
                    $request->file('image')->move('image_flyer/',$request->file('image')->getClientOriginalName());
                    $data2->image = $request->file('image')->getClientOriginalName();
                    $data2->save();
                }
            }
        // }
        return response()->json(
            [
              'success' => 'Flyer webinar Baru Berhasil Ditambahakan',
              'message' => 'Flyer webinar Baru Berhasil Ditambahakan'
            ]
        );
    }
 
    public function store(Request $request)
    {
        $program = Program::where('id', $request->program_id)->first();
        // $webinar  = Pelatihan::all()->count();
        $tanggal = Carbon::parse($request->tanggal)->isoFormat('D MMMM Y');
        $cabang  = Cabang::where('id',$request->cabang_id)->first();
        //create pure pelatihan
        $data    = Pelatihan::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'cabang_id' => $request->cabang_id,
                'program_id' => $request->program_id,
                'tanggal' => $request->tanggal,
                'sampai_tanggal' => $request->sampai,
                'groupwa' => $request->groupwa,
                'slug' => Str::slug($cabang->name.'-'.$tanggal.'-'.$program->name),
                'tempat' => $request->tempat,
                'keterangan' => $request->keterangan,
                'jenis'=> $request->jenis,
                'status' => '1',
            ]
        );
        //menambahkan gambar flyer jika ada isinya
        if ($request->image !== null) {
            # code...
            $data2  = Flyer::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'pelatihan_id' => $data->id,
                    'image' => $request->image,
                ]
            );
            if($request -> hasFile('image'))
            {
                $request->file('image')->move('image_flyer/',$request->file('image')->getClientOriginalName());
                $data2->image = $request->file('image')->getClientOriginalName();
                $data2->save();
            }
        }
        return response()->json(
            [
              'success' => 'webinar Baru Berhasil Dibuat',
              'message' => 'webinar Baru Berhasil Dibuat'
            ]
        );
    }

    public function delete(Request $request)
    {
        $id         = $request->id;
        $pelatihan  = Pelatihan::find($id);
        $flyer      = Flyer::where('pelatihan_id',$id)->first();
        $peserta    = Peserta::where('pelatihan_id',$id)->get();
        // kalau ada gambar flyer maka hapus juga
        if ($flyer !== null) {
            # code...
            File::delete('image_flyer/'.$flyer->image);
        }
        // hapus qr code kalau peserta ada qr codenya
        foreach ($peserta as $key => $item) {
            # code...
            File::delete('images/'.$item->slug.'.png');
        }
        $peserta2 = Peserta::where('pelatihan_id',$id)->delete();
        $pelatihan->delete();

        return response()->json(
            [
              'success' => 'webinar Berhasil Dihapus',
              'message' => 'webinar Berhasil Dihapus'
            ]
        );
    } 

    public function webinar_cabang_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')->where('jenis','webinar')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pelatihans')->where('jenis','webinar')
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function webinar_program_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')->where('jenis','webinar')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pelatihans')->where('jenis', 'webinar')
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function webinar_program_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                # code...
                $data = Pelatihan::whereBetween('tanggal', array($request->dari, $request->sampai))->where('jenis','webinar')->with('program')->select('program_id')->distinct();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }else {
                # code...
                $data = Pelatihan::with('program')->where('jenis','webinar')->select('program_id')->distinct();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }
        }
    }

    public function webinar_cabang_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::whereBetween('tanggal', array($request->dari, $request->sampai))->where('jenis','webinar')->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name.' ( '.$data->cabang->kabupaten->nama.' ) ';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/webinar-webinar-cabang-data/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang')->where('jenis','webinar')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name.' ( '.$data->cabang->kabupaten->nama.' ) ';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/webinar-webinar-cabang-data/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }
        }
    }

    public function webinar_cabang_data_view(Request $request, $cabang_id){
        $data = Cabang::where('id',$cabang_id)->withCount('pelatihan')->first();
        return view('tilawatipusat.webinar.webinar_cabang',compact('data'));
    }

    public function total_webinar_cabang(Request $request, $cabang_id){
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Pelatihan::where('cabang_id', $cabang_id)->where('jenis','webinar')->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                return response()->json($data,200);
            }else{
                $data = Pelatihan::where('cabang_id', $cabang_id)->where('jenis','webinar')->count();
                return response()->json($data,200);
            }
        }
    }
}
