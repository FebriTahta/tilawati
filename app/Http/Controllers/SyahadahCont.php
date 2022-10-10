<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class SyahadahCont extends Controller
{
    public function index_admin(Request $request)
    {
        return view('tilawatipusat.syahadah.index');
    }

    public function data_syahadah_cabang(Request $request, $cabang_id)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::where('cabang_id',$cabang_id)->with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','diklat')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            return $data->peserta->count().' - '.$data->keterangan;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        
                        ->addColumn('tanggals', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->sampai_tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-diklat-link" 
                            data-slug="https://syahadah.nurulfalah.org/daftar-syahadah/'.\Crypt::encrypt($data->id).'" >Syahadah!</a>';
                        })
                ->rawColumns(['tanggals','program','peserta','linkpendaftaran'])
                ->make(true);
            }else{
                $data   = Pelatihan::where('cabang_id', $cabang_id)->with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','diklat');
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            return $data->peserta->count().' - '.$data->keterangan;
                        })
                        ->addColumn('pelatihan_id', function ($data) {
                            return $data->id;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        
                       
                        ->addColumn('linkpendaftaran', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-diklat-link" 
                            data-slug="https://syahadah.nurulfalah.org/daftar-syahadah/'.\Crypt::encrypt($data->id).'" >Syahadah!</a>';
                        })
                        ->addColumn('tanggals', function($data){
                            if ($data->sampai_tanggal !== null) {
                                # code...
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y').' - '.
                                Carbon::parse($data->sampai_tanggal)->isoFormat('dddd, D MMMM Y');
                            }else{
                                return Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y');
                            }
                        })
                ->rawColumns(['tanggals','program','pelatihan_id','peserta','linkpendaftaran'])
                ->make(true);
            }
        }
    }
}
