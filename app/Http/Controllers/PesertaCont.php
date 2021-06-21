<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Peserta;
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
                                if ($rata2 > 85) {
                                    # code...
                                    return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-info">'.$rata2.' (baik)</a>';
                                } else {
                                    # code...
                                    return $button = '<a href="/diklat-nilai-edit/'.$data->id.'" data-id="'.$data->id.'" data-target="#nilaiPeserta" class="badge badge-warning">'.$rata2.' (cukup)</a>';
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
                        $actionBtn .= ' <a href="/diklat-profile-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-info fa fa-pencil-square"><i class="fa fa-user"></i></a>';
                        return $actionBtn;
                    })
            ->rawColumns(['nilai','action','kabupaten'])
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
                ->whereBetween('created_at', array($request->dari, $request->sampai))
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

    public function peserta_lembaga_select(Request $request, $kab)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Lembaga::where('kabupaten_id',$kab)
                    ->orWhere('alamat','LIKE','%' .$search . '%')
                    ->orWhere('name','LIKE','%' .$search . '%')
                    ->orWhere('status','Aktif')
                    ->orWhere('kabupaten_id',$kab)
            		->get();
        }
        else{
            $data = Lembaga::where('kabupaten_id',$kab)->where('status','Aktif')->limit(10)->get();
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
        $diklat  = Pelatihan::where('id',$request->pelatihan_id)->first();
        $tanggal = $diklat->tanggal;
        $kabupaten_id = $request->kota;
        $prov    = Kabupaten::find($kabupaten_id);
        $provinsi_id = $prov->provinsi->id;
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
                'tmptlahir' => $request->tmptlahir,
                'tgllahir' => $request->tgllahir,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'provinsi_id' => $provinsi_id,
                'kabupaten_id' => $kabupaten_id,
            ]
        );
        $qr = \QrCode::size(100)
            ->format('png')
            ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$data->id, public_path('images/'.$data->id.'qrcode.png'));
            return response()->json(
            [
               $data,$qr,
              'success' => 'Penilaian Baru Berhasil Ditambahkan!',
              'message' => 'Penilaian Baru Berhasil Ditambahkan!'
            ]
        );
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        Peserta::find(
            $id
        )->delete();

        $nilai = Nilai::where('peserta_id',$id)->first();
            $nilai->delete();

        return response()->json(
            [
              'success' => 'Peserta Berhasil Dihapus!',
              'message' => 'Peserta Berhasil Dihapus!'
            ]
        );
    }
}
