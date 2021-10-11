<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Penilaian;
use App\Models\Nilai;
use App\Models\Lembaga;
use App\Models\Cabang;
use App\Models\Kabupaten;
use App\Models\Kriteria;
use Illuminate\Support\Str;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;

class PesertaCont extends Controller
{
    public function index($id)
    {
        $pelatihan_id = $id;
        $diklat     = Pelatihan::where('id', $id)->first();
        $program_id = $diklat->program->id;
        $kriteria   = Kriteria::where('program_id',$program_id)->get();
        $penilaian  = Penilaian::where('program_id',$program_id)->get();
        $kab_kosong = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
        $lulus      = Peserta::where('pelatihan_id',$pelatihan_id)->where('bersyahadah', 1)->count();
        $seluruh    = Peserta::where('pelatihan_id',$pelatihan_id)->count();
        $belum_lulus= $seluruh-$lulus;
        return view('tilawatipusat.peserta.index',compact('penilaian','pelatihan_id','diklat','kriteria','kab_kosong','lulus','belum_lulus'));
    }

    public function index2($id)
    {
        $pelatihan_id = $id;
        $diklat     = Pelatihan::where('id', $id)->first();
        $program_id = $diklat->program->id;
        $kriteria   = Kriteria::where('program_id',$program_id)->get();
        $penilaian  = Penilaian::where('program_id',$program_id)->get();
        $kab_kosong = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
        $lulus      = Peserta::where('pelatihan_id',$pelatihan_id)->where('bersyahadah', 1)->count();
        $seluruh    = Peserta::where('pelatihan_id',$pelatihan_id)->count();
        $belum_lulus= $seluruh-$lulus;
        return view('tilawatipusat.peserta.index2',compact('penilaian','pelatihan_id','diklat','kriteria','kab_kosong','lulus','belum_lulus'));
    }

    public function peserta_data(Request $request,$id)
    {
        if(request()->ajax())
        {
            $data   = Peserta::where('pelatihan_id', $id)->with('certificate')->with('pelatihan')->with('kabupaten')->with('nilai')->where('status',1)->orderBy('id','asc');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                    $total  = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<button data-target="#addkota" data-id="'.$data->id.'" data-toggle="modal" class="btn btn-sm btn-danger">kosong / salah penulisan</button>';
                            }
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            $actionBtn .= ' <a href="/halaman-update-data-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-primary "><i class="fa fa-edit"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('krits', function ($data) {
                            if ($data->kriteria == null) {
                                # code...
                                return '<a href="#" class="badge badge-warning">menunggu penilaian</a>';

                            } else {
                                # code...
                                return '<p class="text-success">'.$data->kriteria.'</p>';
                            }
                            
                        })
                        ->addColumn('ttl', function($data){
                            $ttl = $data->tmptlahir.' - '.Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $ttl;
                        })
                        ->addColumn('alamatmodul', function($data){
                            if ($data->alamatx == null) {
                                # code...
                                $ttl = '<a href="#" data-id="'.$data->id.'" style="text-danger" data-alamatx="'.$data->alamatx.'" data-toggle="modal" data-target="#modal-modul"> Kosong </a>';
                                return $ttl;
                            }else {
                                # code...
                                $ttl = '<a href="#" data-id="'.$data->id.'" data-alamatx="'.$data->alamatx.'" data-toggle="modal" data-target="#modal-modul">'.$data->alamatx.'</a>';
                                return $ttl;
                            }
                        })
                ->rawColumns(['nilai','action','kabupaten','ttl','krits','alamatmodul'])
                ->make(true);
        }
    }

    public function ubah_alamat_modul(Request $request)
    {
        $data = Peserta::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'alamatx'=>$request->alamatx,
            ]
        );

        return response()->json(
            [
            'success' => 'Alamat pengiriman modul diubah',
            'message' => 'Alamat pengiriman modul diubah'
            ]
        );
    }

    public function peserta_data_keseluruhan(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 85) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 85 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name;
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        
                ->rawColumns(['nilai','kabupaten','cabang','program','tgllahir'])
                ->make(true);
            }else {
                # code...
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 85) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 85 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name;
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        
                ->rawColumns(['nilai','kabupaten','cabang','program','tgllahir'])
                ->make(true);
            }
        }
    }

    public function peserta_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = Peserta::
                whereBetween('tanggal', array($request->dari, $request->sampai))
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = Peserta::whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                })
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_cabang_total(Request $request, $cabang_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_diklat_total(Request $request, $pelatihan_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->where('pelatihan_id', $pelatihan_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
                ->where('pelatihan_id', $pelatihan_id)
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_lembaga_select(Request $request, $kab)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Lembaga::where('kabupaten_id',$kab && 'status', 'Aktif')
                    ->orWhere('alamat','LIKE','%' .$search . '%')
                    ->orWhere('name','LIKE','%' .$search . '%')
                    ->orWhere('kabupaten_id',$kab)
            		->get();
        }
        else{
            $data = Lembaga::where('kabupaten_id',$kab)->where('status','Aktif')->get();
        }
        return response()->json($data);
    }

    public function peserta_kota_select(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kabupaten::Where('nama','LIKE','%' .$search . '%')
            		->get();
        }
        else{
            $data = Kabupaten::orderBy('nama','desc')->limit(10)->get();
        }
        return response()->json($data);
    }

    public function create(Request $request, $id)
    {
        $pelatihan_id   = $id;
        $diklat         = Pelatihan::find($id);
        $diklat_id      = $diklat->id;
        $cabang         = Cabang::find($diklat->cabang_id);
        $kabupaten_id   = $cabang->kabupaten_id;

        return view('tilawatipusat.peserta.create',compact('diklat_id','kabupaten_id','diklat'));
    }

    public function store(Request $request){
        $diklat         = Pelatihan::where('id',$request->pelatihan_id)->first();
        $tanggal        = $diklat->tanggal;
        $kabupaten_id   = $request->kota;
        $kabupaten      = Kabupaten::find($kabupaten_id);
        $tmptlahir      = Kabupaten::find($request->tmptlahir);
        $kota           = substr($kabupaten->nama,4);
        $tmptlahir      = substr($tmptlahir->nama,4);
        $provinsi_id    = $kabupaten->provinsi->id;
        $lembaga        = Lembaga::where('id',$request->lembaga_id)->first();
        $slug           = Str::slug($request->name.'-'.$diklat->program->name.'-'.Carbon::parse($tanggal)->isoFormat('MMMM-D-Y').'-'.$diklat->cabang->name.'-'.$diklat->cabang->kabupaten->nama);
        if ($lembaga !== null) {
            # code...
            if ($lembaga->status == 'Aktif') {
                # code...
                $data = Peserta::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'cabang_id' => $diklat->cabang_id,
                        'phonegara_id' => 175,
                        'lembaga_id' => $request->lembaga_id,
                        'pelatihan_id' => $request->pelatihan_id,
                        'program_id' => $diklat->program_id,
                        'tanggal' => $tanggal,
                        'name' => $request->name,
                        'email' => $request->email,
                        'pos' => $request->pos,
                        'slug' => $slug,
                        'tmptlahir' => $tmptlahir,
                        'tgllahir' => $request->tgllahir,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kota' => $kota,
                        'status'=>1
                    ]
                );
                $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                $program_id = $program->program_id;
                $qr = \QrCode::size(200)
                    ->format('png')
                    // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                    ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                    return response()->json(
                    [
                       $data,$qr,
                      'success' => 'Peserta Baru Berhasil Ditambahkan!',
                      'message' => 'Peserta Baru Berhasil Ditambahkan!'
                    ]
                );
            }else{
                $data = 'error Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!';
                return response()->json(
                    [
                        $data,
                        'error' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!',
                        'message' => 'Asal lembaga peserta sudah tidak aktif, mohon hubungi admin!'
                    ]
                );
            }
        } else {
            # code...
            $data = Peserta::updateOrCreate(
                [
                  'id' => $request->id
                ],
                [
                    'cabang_id' => $diklat->cabang_id,
                    'lembaga_id' => $request->lembaga_id,
                    'pelatihan_id' => $request->pelatihan_id,
                    'program_id' => $diklat->program_id,
                    'tanggal' => $tanggal,
                    'name' => $request->name,
                    'email' => $request->email,
                    'tmptlahir' => $tmptlahir,
                    'tgllahir' => $request->tgllahir,
                    'slug'=>$slug,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'provinsi_id' => $provinsi_id,
                    'kabupaten_id' => $kabupaten_id,
                    'kota' => $kota,
                    'status'=>1
                ]
            );
            $program = Pelatihan::where('id', $data->pelatihan_id)->first();
            $program_id = $program->program_id;
            $qr = \QrCode::size(100)
                ->format('png')
                // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
                ->generate('https://www.profile.tilawatipusat.com/'.$slug, public_path('images/'.$slug.'.png'));
                return response()->json(
                [
                   $data,$qr,
                  'success' => 'Peserta Baru Berhasil Ditambahkan!',
                  'message' => 'Peserta Baru Berhasil Ditambahkan!'
                ]
            );
        }
    }
    public function delete(Request $request)
    {
        $id     = $request->id;
        $data   =Peserta::find($id);
        //hapus qr
        File::delete('images/'.$data->slug.'.png');
        //hapus data 
        $data->delete();
        return response()->json(
            [
              'success' => 'Peserta Berhasil Dihapus!',
              'message' => 'Peserta Berhasil Dihapus!'
            ]
        );
    }

    public function seluruh_peserta(Request $request)
    {
        return view('tilawatipusat.peserta.seluruh');
    }

    public function seluruh_peserta_data(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai')
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                });
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                    $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('ttl', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','ttl'])
                ->make(true);
            }else{
                $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai')
                ->whereHas('pelatihan', function($query){
                    return $query->where('jenis','diklat');
                });;
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('ttl', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','ttl'])
                ->make(true);
            }
            
        }
    }

    public function seluruh_peserta_data_kabupaten(Request $request, $kabupaten_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('kabupaten_id', $kabupaten_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program'])
                ->make(true);
            }else{
                $data   = Peserta::where('kabupaten_id', $kabupaten_id)->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program'])
                ->make(true);
            }
            
        }
    }

    public function peserta_kabupaten_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_program_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
                ->select('program_id', DB::raw('count(*) as total'))
                ->groupBy('program_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_total_data(Request $request, $kabupaten_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_total_cabang(Request $request, $kabupaten_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('kabupaten_id', $kabupaten_id)
                ->select('cabang_id', DB::raw('count(*) as total'))
                ->groupBy('cabang_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten_cabang_total(Request $request,$cabang_id)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')->where('cabang_id', $cabang_id)
                ->select('kabupaten_id', DB::raw('count(*) as total'))
                ->groupBy('kabupaten_id')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function peserta_kabupaten(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                    
                })
                ->addColumn('action', function ($data) {
                    if ($data->kabupaten !== null) {
                        $btn = '<a href="/diklat-peserta-data-kabupaten/'.$data->kabupaten->id.'" class="btn btn-sm btn-info"> check </a>';
                        return $btn;
                    }else{
                        return '-';
                    }
                    
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }else{
                $data   = Peserta::with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->kabupaten !== null) {
                        $btn = '<a href="/diklat-peserta-data-kabupaten/'.$data->kabupaten->id.'" class="btn btn-sm btn-info"> check </a>';
                        return $btn;
                    }else{
                        return '-';
                    }
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }
        }
    }

    public function peserta_kabupaten_view(Request $request, $kabupaten_id)
    {
        $kabupaten = Kabupaten::find($kabupaten_id);
        return view('tilawatipusat.peserta.kabupaten',compact('kabupaten'));
    }

    public function peserta_kabupaten_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('cabang_id',$cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }else{
                $data   = Peserta::where('cabang_id',$cabang_id)->with('kabupaten')->select('kabupaten_id')->distinct();
                return DataTables::of($data)
                ->addColumn('kabupaten', function ($data) {
                    if ($data->kabupaten !== null) {
                        # code...
                        return $data->kabupaten->nama;
                    } else {
                        # code...
                        return '<span class="badge badge-warning">kosong</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['kabupaten','action'])
                ->make(true);
            }
        }
    }

    public function peserta_cabang_pilih(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::whereBetween('tanggal', array($request->dari, $request->sampai))->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name.' ( '.$data->cabang->kabupaten->nama.' ) ';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-cabang/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name.' ( '.$data->cabang->kabupaten->nama.' ) ';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-cabang/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }
        }
    }

    public function peserta_program_pilih(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::whereBetween('tanggal', array($request->dari, $request->sampai))->with('program')->select('program_id')->distinct();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-program/'.$data->program->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }else{
                $data   = Peserta::with('program')->select('program_id')->distinct();
                return DataTables::of($data)
                ->addColumn('program', function ($data) {
                    return $data->program->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-program/'.$data->program->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['program','action'])
                ->make(true);
            }
        }
    }

    public function peserta_kabupaten_cabang_pilih(Request $request, $kabupaten_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::where('kabupaten_id', $kabupaten_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="/diklat-peserta-diklat-cabang/'.$data->cabang->id.'" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }else{
                $data   = Peserta::where('kabupaten_id',$kabupaten_id)->with('cabang')->select('cabang_id')->distinct();
                return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->name;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="#" class="btn btn-sm btn-info"> check </a>';
                    return $btn;
                })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }
        }
    }

    public function peserta_cabang(Request $request, $cabang_id)
    {
        $cabang = Cabang::find($cabang_id);
        return view('tilawatipusat.peserta.cabang',compact('cabang'));
    }

    public function peserta_program(Request $request, $program_id)
    {
        $program = Program::find($program_id);
        return view('tilawatipusat.peserta.program',compact('program'));
    }

    public function peserta_program_data(Request $request, $program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('program_id', $program_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai')->with('cabang');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('keterangan', function ($data) {
                            if ($data->bersyahadah == 1) {
                                # lulus code...
                                return '<span class="badge badge-success">Bersyahadah</span>';
                            }else {
                                # tidak lulus code...
                                return '<span class="badge badge-danger">Belum Bersyahadah</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        // ->addColumn('action', function($data){
                        //     $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                        //     $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                        //     return $actionBtn;
                        // })
                ->rawColumns(['nilai','kabupaten','keterangan','tgllahir'])
                ->make(true);
            }else{
                $data   = Peserta::where('program_id', $program_id)->with('pelatihan')->with('kabupaten')->with('nilai')->with('cabang');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('keterangan', function ($data) {
                            if ($data->bersyahadah == 1) {
                                # lulus code...
                                return '<span class="badge badge-success">Bersyahadah</span>';
                            }else {
                                # tidak lulus code...
                                return '<span class="badge badge-danger">Belum Bersyahadah</span>';
                            }
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $data->tmptlahir.'-'.$a;
                        })
                        // ->addColumn('action', function($data){
                        //     $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                        //     $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                        //     $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                        //     return $actionBtn;
                        // })
                ->rawColumns(['nilai','kabupaten','tgllahir','keterangan'])
                ->make(true);
            }
            
        }
    }

    public function peserta_cabang_data(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Peserta::where('cabang_id', $cabang_id)->whereBetween('tanggal', array($request->dari, $request->sampai))->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $a;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','tgllahir'])
                ->make(true);
            }else{
                $data   = Peserta::where('cabang_id', $cabang_id)->with('pelatihan')->with('kabupaten')->with('nilai');
                return DataTables::of($data)
                        ->addColumn('nilai', function ($data) {
                            if ($data->nilai->count() == 0) {
                                # code...
                                return $button = '<a href="#" data-toggle="modal" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-danger">belum dinilai</a>';
                            }else{
                                // return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">sudah dinilai</a>';
                                $total = $data->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $total2 = $data->nilai->where("kategori","skill")->sum('nominal');
                                    $total3 = $data->nilai->where("kategori","skill")->count();
                                    
                                    // $rata2 = $data->nilai->sum('nominal');
                                    $rata2 = ($total + $total2)/($total3+1);
                                    if ($rata2 > 84) {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-primary">'.$rata2.' (baik)</a>';
                                    }
                                    elseif($rata2 < 84 && $rata2 < 75){
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (belum bersyahadah)</a>';
                                    }
                                    else {
                                        # code...
                                        return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (cukup)</a>';
                                    }
                                
                            }
                            return $button;
                        })
                        ->addColumn('pelatihan', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('kabupaten', function ($data) {
                            if ($data->kabupaten !== null) {
                                # code...
                                return $data->kabupaten->nama;
                            } else {
                                # code...
                                return '<span class="badge badge-warning">kosong</span>';
                            }
                        })
                        ->addColumn('program', function ($data) {
                            return $data->pelatihan->program->name;
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->pelatihan->cabang->name.' ('.$data->pelatihan->cabang->kabupaten->nama.')';
                        })
                        ->addColumn('tgllahir', function ($data) {
                            $a = Carbon::parse($data->tgllahir)->isoFormat('D MMMM Y');
                            return $a;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-trash"></i></a>';
                            $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info "><i class="fa fa-user"></i></a>';
                            $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->slug.'.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['nilai','action','kabupaten','program','tgllahir'])
                ->make(true);
            }
            
        }
    }

    public function add_kota(Request $request)
    {
        if(request()->ajax())
        {
            if ($request->peserta_id !== null) {
                # code...
                $pes_id = $request->peserta_id;
                $kab_id = $request->sel_kab;
                $data = Peserta::where('id',$pes_id)->update([
                    'kabupaten_id' => $kab_id
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

    public function peserta_yang_kabupatennya_kosong(Request $request, $pelatihan_id)
    {
        if(request()->ajax())
        {
            $data = Peserta::where('pelatihan_id',$pelatihan_id)->where('kabupaten_id', null)->count();
            return response()->json($data,200);
        }
    }

    public function update_peserta_view($peserta_id)
    {
        $peserta = Peserta::find($peserta_id);
        return view('tilawatipusat.peserta.update',compact('peserta'));
    }

    public function update_data_peserta(Request $request)
    {
        $telp           = $request->kode.$request->phone;
        $telp1          = $request->kode1.$request->phone1;
        $dpp            = $request->pelatihan_id;
        $dp             = Peserta::where('id',$request->id)->first();
        $kabupaten_kota = Kabupaten::where('id',$request->kabupaten_id)->first();
        $tempatlahir    = Kabupaten::where('id',$request->tmptlahir)->first();
        $slug           = Str::slug($request->name.'-'.$dp->program->name.'-'.
                          Carbon::parse($dp->tanggal)->isoFormat('D-MMMM-Y').'-'.$dp->cabang->name.'-'.
                          $dp->cabang->kabupaten->nama);

                          $peserta                = Peserta::updateOrCreate(
                            [
                                'id'            => $request->id
                            ],
                            [
                                'nik'           => $request->nik,
                                // 'phonegara_id'  => $kode_negara,
                                // 'pelatihan_id'  => $request->pelatihan_id,
                                // 'program_id'    => $diklat->program_id,
                                // 'cabang_id'     => $diklat->cabang->id,
                                'lembaga_id'    => $request->lembaga_id,
                                'provinsi_id'   => $kabupaten_kota->provinsi_id,
                                'kabupaten_id'  => $kabupaten_kota->id,
                                'kecamatan_id'  => $request->kecamatan_id,
                                'kelurahan_id'  => $request->kelurahan_id,
                                'slug'          => $slug,
                                'tanggal'       => $dp->tanggal,
                                'name'          => $request->name,
                                // 'tmptlahir'     => $tempatlahir->nama,
                                'tgllahir'      => $request->tgllahir,
                                'alamat'        => $request->alamat,
                                'alamatx'       => $request->alamatx,
                                'kota'          => $kabupaten_kota->nama,
                                'telp'          => $request->kode.$request->phone,
                                'pos'           => $request->pos,
                                'email'         => $request->email,
                                'bersyahadah'   => $request->bersyahadah,
                                'jilid'         => $request->jilid,
                                'kriteria'      => $request->kriteria,
                                'munaqisy'      => $request->munaqisy,
                            ]
                        );
                        return redirect()->back()->with('success','Data Berasil Diperbarui');
    }

    public function syahadah(Request $request, $program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::where('program_id', $program_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $data2  = Peserta::where('program_id', $program_id)->where('bersyahadah', 1)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                $data3  = ($data - $data2);
        
                $result = $data2.'- telah bersyahadah & '.$data3.'- belum bersyahadah';
                return response()->json($result,200);
            }else{
                $data = Peserta::where('program_id', $program_id)->count();
                $data2  = Peserta::where('program_id', $program_id)->where('bersyahadah', 1)->count();
                $data3  = ($data - $data2);
        
                $result = $data2.'- telah bersyahadah & '.$data3.'- belum bersyahadah';
                return response()->json($result,200);
            }
        }
    }

    public function total_peserta_program(Request $request,$program_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data = Peserta::where('program_id', $program_id)
                ->whereBetween('tanggal', array($request->dari, $request->sampai))->count();
                return response()->json($data,200);
            }else{
                $data = Peserta::where('program_id', $program_id)->count();
                return response()->json($data,200);
            }
        }
    }

}
