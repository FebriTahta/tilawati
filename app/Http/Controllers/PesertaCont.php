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
use Illuminate\Http\Request;

class PesertaCont extends Controller
{
    public function index($id)
    {
        $pelatihan_id = $id;
        $diklat = Pelatihan::where('id', $id)->first();
        $program_id = $diklat->program->id;
        $kriteria = Kriteria::where('program_id',$program_id)->get();
        $penilaian = Penilaian::where('program_id',$program_id)->get();
        
        return view('tilawatipusat.peserta.index',compact('penilaian','pelatihan_id','diklat','kriteria'));
    }

    public function peserta_data(Request $request,$id)
    {
        if(request()->ajax())
        {
            $data   = Peserta::where('pelatihan_id', $id)->with('pelatihan')->with('kabupaten')->with('nilai');
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
                        return $data->kabupaten->nama;
                    })
                    ->addColumn('action', function($data){
                        $actionBtn = ' <a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger fa fa-pencil-square"><i class="fa fa-trash"></i></a>';
                        $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                        return $actionBtn;
                    })
            ->rawColumns(['nilai','action','kabupaten'])
            ->make(true);
        }
    }

    public function peserta_data_keseluruhan(Request $request)
    {
        if (request()->ajax()) {
            # code...
            $data   = Peserta::with('pelatihan')->with('kabupaten')->with('nilai')->orderBy('id','desc');
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
                        return $data->kabupaten->nama;
                    })
                    ->addColumn('cabang', function ($data) {
                        return $data->pelatihan->cabang->name;
                    })
            ->rawColumns(['nilai','kabupaten','cabang','program'])
            ->make(true);
        }
        
    }

    public function peserta_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('tanggal', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
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
        if ($lembaga !== null) {
            # code...
            if ($lembaga->status == 'Aktif') {
                # code...
                $data = Peserta::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'lembaga_id' => $request->lembaga_id,
                        'pelatihan_id' => $request->pelatihan_id,
                        'tanggal' => $tanggal,
                        'name' => $request->name,
                        'email' => $request->email,
                        'tmptlahir' => $tmptlahir,
                        'tgllahir' => $request->tgllahir,
                        'alamat' => $request->alamat,
                        'telp' => $request->telp,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kota' => $kota,
                    ]
                );
                $program = Pelatihan::where('id', $data->pelatihan_id)->first();
                $program_id = $program->program_id;
                $qr = \QrCode::size(100)
                    ->format('png')
                    ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
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
                    'lembaga_id' => $request->lembaga_id,
                    'pelatihan_id' => $request->pelatihan_id,
                    'tanggal' => $tanggal,
                    'name' => $request->name,
                    'email' => $request->email,
                    'tmptlahir' => $tmptlahir,
                    'tgllahir' => $request->tgllahir,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'provinsi_id' => $provinsi_id,
                    'kabupaten_id' => $kabupaten_id,
                    'kota' => $kota,
                ]
            );
            $program = Pelatihan::where('id', $data->pelatihan_id)->first();
            $program_id = $program->program_id;
            $qr = \QrCode::size(100)
                ->format('png')
                ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id.'/'.$program_id.'/'.$data->pelatihan_id, public_path('images/'.$data->id.'qrcode.png'));
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
        $id = $request->id;
        Peserta::find(
            $id
        )->delete();
        
        return response()->json(
            [
              'success' => 'Peserta Berhasil Dihapus!',
              'message' => 'Peserta Berhasil Dihapus!'
            ]
        );
    }
}
