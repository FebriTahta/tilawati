<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Cabang;
use App\Models\Induksertifikat;
use DataTables;
use Carbon\Carbon;
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
        $sertifikat_lama = Certificate::where('induksertifikat_id',$id)->delete();
        // if ($sertifikat_lama->count() !== 0) {
        //     # code...
        //     $sertifikat_lama->delete();
        // }
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
                $data   = Induksertifikat::with('cabang','program','certificate')->orderBy('tgl_awal','desc');
                return DataTables::of($data)
                    ->addColumn('cabang', function ($data) {
                        return $data->cabang->name;
                    })
                    ->addColumn('tanggal', function ($data) {
                        if ($data->tgl_akhir == null) {
                            # code...
                            return Carbon::parse($data->tgl_awal)->isoFormat('dddd, D MMMM Y');
                        }else{
                            $tanggal = Carbon::parse($data->tgl_awal)->isoFormat('dddd, D MMMM Y').
                            ' - '.Carbon::parse($data->tgl_awal)->isoFormat('dddd, D MMMM Y');
                            return $tanggal;
                        }
                    })
                    ->addColumn('certificate', function ($data) {
                        $total = $data->certificate->count().' Sertifikat';
                        if ($total == 0) {
                            # code...
                            return '<a href="https://sertifikat.tilawatipusat.com/'.$data->slug.'" target="_blank" class="text-danger">'.$total.' - sertifikat'.'</a>';
                        } else {
                            # code...
                            return '<a href="https://sertifikat.tilawatipusat.com/'.$data->slug.'" target="_blank" class="text-success">'.$total.' - sertifikat'.'</a>';
                        }
                    })
                    ->addColumn('action', function($data){
                        $actionBtn  = ' <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-import" class="btn btn-success btn-sm"> <i class="fa fa-upload"></i> Import</button>';
                        $actionBtn .= ' <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#modal-hapus" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus!</button>';
                        return $actionBtn;
                    })
                ->rawColumns(['cabang','certificate','tanggal','action'])
                ->make(true);
            }
        }
    }

    public function generate_program_id(Request $request)
    {
        $id = $request->id;
        $pelat = Induksertifikat::where('id',$id)->with('cabang','program')->first();
        $tanggal = Carbon::parse($pelat->tgl_awal)->isoFormat('D MMMM Y');
        $pelat->slug = Str::slug($pelat->cabang->name.'-'.$tanggal.'-'.$pelat->program->name);
        $pelat->update();
        return redirect()->back();
    }

    public function delete_induksertifikat(Request $request)
    {
        $id = $request->id;
        Induksertifikat::find($id)->delete();
        $data = Certificate::where('induksertifikat_id', $id)->get();
        if ($data->count() !== null) {
            # code...
            foreach ($data as $key => $value) {
                # code...
                $value->delete();
            }
        }
        return Response()->json([
            $data,
            'success'=>'E-Sertifikat Peserta Berhasil Dihapus'
        ]);
    }

    public function store_induksertifikat(Request $request)
    {
        $program_name   = $request->program;
        $cabang_name    = $request->cabang;
        $cek_program    = Program::where('name',$program_name)->first();
        $cek_cabang     = Cabang::where('name',$cabang_name)->first();
        $tanggal        = Carbon::parse($request->tgl_awal)->isoFormat('D MMMM Y');
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
                                'tempat'        => $request->tempat,
                                'slug'          => Str::slug($cek_cabang->name.'-'.$tanggal.'-'.$cek_program->name)
                            ]
                        );
                        return redirect()->back();
                    }else{
                        return redirect()->back()->withFail('Cabang '.$request->cabang.' Tidak Terdaftar, Pilih Dari Daftar Cabang Yang Terdaftar');;
                    }
        }else {
            # code...
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
                    if($cek_cabang !== null){
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
                                        'tempat'        => $request->tempat,
                                        'slug'          => Str::slug($cek_cabang->name.'-'.$tanggal.'-'.$dtpro->name)
                                    ]
                                );
                                return redirect()->back();
                            }else{
                                return redirect()->back()->withFail('Cabang '.$request->cabang.' Tidak Terdaftar, Pilih Dari Daftar Cabang Yang Terdaftar');;
                            }
            return ''.'sukses input program baru'.$dtpro->name.'-'.$cabang_name;
        }
    }
}
