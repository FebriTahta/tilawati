<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
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

    public function terbitkan_syahadah(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $diklat = Pelatihan::where('id', $request->id)->update(
                [
                    'syahadah'=>'1'
                ]
            );

            return response()->json(
                [
                    'status'=>200,
                    'message'=>'Syahadah telah diterbitkan'
                ]
            );
        }
    }

    public function tarik_syahadah(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $diklat = Pelatihan::where('id', $request->id)->update(
                [
                    'syahadah'=>''
                ]
            );

            return response()->json(
                [
                    'status'=>200,
                    'message'=>'Syahadah telah ditarik'
                ]
            );
        }
    }


    public function syahadah_pusat(Request $request)
    {
        if ($request->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','diklat')->where('syahadah','1')
                ->whereBetween('updated_at', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('cabang', function($data){
                            return $data->cabang->name;
                        })
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
                        ->addColumn('linksyahadah', function ($data) {
                            return '<a href="#" data-id="'.$data->id.'" data-toggle="modal" data-target=".bs-example-modal-diklat-link" 
                            data-slug="https://syahadah.nurulfalah.org/daftar-syahadah/'.\Crypt::encrypt($data->id).'" >Syahadah!</a>';
                        })
                        ->addColumn('tanggal_terbit', function($data){
                            return Carbon::parse($data->updated_at)->isoFormat('dddd, D MMMM Y');
                        })
                        ->addColumn('cetak', function ($data) {
                            $btn    = '<a href="#" class="btn btn-sm btn-primary">B5</a>';
                            $btn   .= ' <a href="#" class="btn btn-sm btn-info">A4</a>';
                            $btn   .= ' <a href="#" class="btn btn-sm btn-success">A4</a>';
                            return $btn;
                        })
                ->rawColumns(['tanggals','program','peserta','linksyahadah','cabang','cetak','tanggal_terbit'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc')->where('jenis','diklat')->where('syahadah','1');
                return DataTables::of($data)
                        ->addColumn('cabang', function($data){
                            return $data->cabang->name;
                        })
                        ->addColumn('peserta', function($data){
                            return $data->peserta->where('bersyahadah','1')->count(). ' LULUS DARI ' . $data->peserta->count();
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                        ->addColumn('linksyahadah', function ($data) {
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
                        ->addColumn('tanggal_terbit', function($data){
                            return Carbon::parse($data->updated_at)->isoFormat('dddd, D MMMM Y');
                        })
                        ->addColumn('cetak', function ($data) {
                            $btn    = '<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalb5" data-id="'.$data->id.'">V.1</a>';
                            $btn   .= ' <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalb52" data-id="'.$data->id.'">V.2</a>';
                            return $btn;
                        })
                ->rawColumns(['tanggals','program','peserta','linksyahadah','cabang','cetak','tanggal_terbit'])
                ->make(true);
            }
        }
    }

    public function syahadah_terbit_pusat(Request $request)
    {
     
        if ($request->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                # code...
                $terbit = Pelatihan::where('syahadah','1')->whereBetween('updated_at', array($request->dari, $request->sampai))->count();
                $peserta_terbit = Peserta::where('bersyahadah','1')->whereHas('pelatihan', function($q) use ($request){
                    $q->where('syahadah','1')->whereBetween('updated_at', array($request->dari, $request->sampai));
                })->count();

                return response()->json(
                    [
                        'terbit'=>$terbit,
                        'peserta_terbit'=>$peserta_terbit,
                    ]
                );
            }else {
                # code...
                $terbit = Pelatihan::where('syahadah','1')->count();
                $peserta_terbit = Peserta::where('bersyahadah','1')->whereHas('pelatihan', function($q){$q->where('syahadah','1');})->count();
                
                return response()->json(
                    [
                        'terbit'=>$terbit,
                        'peserta_terbit'=>$peserta_terbit,
                    ]
                );
            }
        }
    }
}
