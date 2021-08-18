<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use DataTables;
use Carbon;
use Excel;
use App\Models\Certificate;
use App\Imports\EsertifikatImport;
use Illuminate\Http\Request;

class SertifikatCont extends Controller
{
    public function index()
    {
        return view('tilawatipusat.sertifikat.index');
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
        $data = Excel::Import(new EsertifikatImport($id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'E-Sertifikat Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }
}
