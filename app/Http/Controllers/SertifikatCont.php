<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Cabang;
use App\Models\Induksertifikat;
use DataTables;
use Carbon;
use Excel;
use App\Models\Certificate;
use App\Imports\EsertifikatImport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SertifikatCont extends Controller
{
    public function index()
    {
        $cabang  = Cabang::select('id','name')->get();
        $program = Program::select('id','name')->get();
        return view('tilawatipusat.sertifikat.index',compact('program','cabang'));
    }

    public function daftar_pelatihan(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::with('cabang','program')->withCount('certificate')->orderBy('id','desc')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('certificate', function($data){
                            
                            # code...
                            $total = $data->certificate->count();
                            if ($total == 0) {
                                # code...
                                return '<p class="text-danger">'.$total.' - sertifikat'.'</p>';
                            } else {
                                # code...
                                return '<p class="text-success">'.$total.' - sertifikat'.'</p>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <button type="button" data-toggle="modal" data-target="#modal-import" data-id="'.$data->id.'" class="btn btn-success btn-sm"> <i class="fa fa-upload"></i> Import</button>';
                            return $actionBtn;
                        })
                        ->addColumn('tanggal', function($data){
                            $tgl = Carbon\Carbon::parse($data->tanggal)->isoFormat('D-MMMM-Y');
                            return $tgl;
                        })
                ->rawColumns(['cabang','program','action','certificate','tanggal'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc');
                return DataTables::of($data)
                        ->addColumn('certificate', function($data){
                            # code...
                            $total = $data->certificate->count();
                            if ($total == 0) {
                                # code...
                                return '<a href="https://sertifikat.tilawatipusat.com/'.$data->slug.'" target="_blank" class="text-danger">'.$total.' - sertifikat'.'</a>';
                            } else {
                                # code...
                                return '<a href="https://sertifikat.tilawatipusat.com/'.$data->slug.'" target="_blank" class="text-success">'.$total.' - sertifikat'.'</a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('action', function($data){
                            $actionBtn = ' <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-import" class="btn btn-success btn-sm"> <i class="fa fa-upload"></i> Import</button>';
                            return $actionBtn;
                        })
                        ->addColumn('tanggal', function($data){
                            $tgl = Carbon\Carbon::parse($data->tanggal)->isoFormat('D-MMMM-Y');
                            return $tgl;
                        })
                ->rawColumns(['cabang','program','action','certificate','tanggal'])
                ->make(true);
            }
        }
    }

    public function sertifikat($diklat_id)
    {
        if(request()->ajax())
        {
            $data   = Certificate::with('peserta');
                return DataTables::of($data)
                        ->addColumn('name',function($data){
                            $name = strtolower($data->peserta->name);
                            return $name;
                        })
                        ->addColumn('download',function($data){
                            $ok = '<a href="'.$data->link.'" target="_blank" class="btn btn-sm btn-success text-white">unduh</a>';
                            return $ok;
                        })
                ->rawColumns(['download','name'])
                ->make(true);
        }
    }

    public function import_e_sertifikat(Request $request)
    {
        $id = $request->id ;
        $sertifikat_lama = Certificate::where('pelatihan_id',$id)->delete();
        // $peserta_lama    = Peserta::where('pelatihan_id',$id)->delete();
        $data = Excel::Import(new EsertifikatImport($id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'E-Sertifikat Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function data_induksertifikat()
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Induksertifikat::with('cabang','program')->orderBy('tgl_awal','desc')
                ->whereBetween('tgl_awal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                    ->addColumn('cabang', function ($data) {
                        return $data->cabang->name;
                    })
                ->rawColumns(['cabang'])
                ->make(true);
            }else{
                $data   = Induksertifikat::with('cabang','program')->orderBy('tgl_awal','desc');
                return DataTables::of($data)
                    ->addColumn('cabang', function ($data) {
                        return $data->cabang->name;
                    })
                    ->addColumn('action', function ($data){
                        if ($data->program !== null) {
                            # code...
                            $action = '<a href="/generate_sertifikat_peserta/'.$data->program->id.'">generate peserta</a>';
                            return $action;
                        }
                    })
                ->rawColumns(['cabang','action'])
                ->make(true);
            }
        }
    }

    public function generate_program_id(Request $request)
    {
        $serti = Certificate::where('pelatihan_id',5090)->get();
        $pelat = Pelatihan::where('id',5090)->with('program')->first();
        foreach ($serti as $key => $value) {
            # code...
            $value->program_id = $pelat->program->id;
            $value->update();
        }
        return redirect()->back();
    }

    public function store_induksertifikat(Request $request)
    {
        $program_name   = $request->program;
        $cabang_name    = $request->cabang;
        $cek_program    = Program::where('name',$program_name)->first();
        $cek_cabang     = Cabang::where('name',$cabang_name)->first();

        if ($cek_program !== null) {
            # code...
            if($cek_cabang !== null){
                Induksertifikat::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'tgl_awal'      => $request->tgl_awal,
                        'tgl_akhir'     => $request->tgl_akhir,
                        'program_id'    => $cek_program->id,
                        'program_name'  => $cek_program->name,
                        'cabang_id'     => $cek_cabang->id,
                        'tempat'        => $request->tempat
                    ]
                );
                return redirect()->back();
            }else{
                return redirect()->back()->withFail('Cabang '.$request->cabang.' Tidak Terdaftar, Pilih Dari Daftar Cabang Yang Terdaftar');;
            }
        }else{
            if($cek_cabang !== null){
                $dtpro      = Program::updateOrCreate(
                    [
                      'id'  => $request->id
                    ],
                    [
                        'name' => $program_name,
                        'slug' => Str::slug($program_name),
                        'status' => 2,
                    ]
                );
                Induksertifikat::updateOrCreate(
                    [
                      'id' => $request->id
                    ],
                    [
                        'tgl_awal'      => $request->tgl_awal,
                        'tgl_akhir'     => $request->tgl_akhir,
                        'program_id'    => $dtpro->id,
                        'program_name'  => $program_name,
                        'cabang_id'     => $cek_cabang->id,
                        'tempat'        => $request->tempat
                    ]
                );
                return redirect()->back();
            }else{
                return redirect()->back()->withFail('Cabang '.$request->cabang.' Tidak Terdaftar, Pilih Dari Daftar Cabang Yang Terdaftar');;
            }
        }
    }
}
