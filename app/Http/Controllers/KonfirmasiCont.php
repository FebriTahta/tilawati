<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Carbon;
use DataTables;
use Illuminate\Http\Request;

class KonfirmasiCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.konfirmasi.index');
    }

    public function data_diklat_menunggu_konfirmasi(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->dari))
            {
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc')
                ->whereBetween('tanggal', array($request->dari, $request->sampai));
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                ->rawColumns(['cabang','program','peserta'])
                ->make(true);
            }else{
                $data   = Pelatihan::with('cabang','program')->withCount('peserta')->orderBy('id','desc');
                return DataTables::of($data)
                        ->addColumn('peserta', function($data){
                            if ($data->peserta_count == 0) {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-danger">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            } else {
                                # code...
                                return '<a href="/daftar-data-peserta/'.$data->slug.'" class="text-success">'.$data->peserta_count.' - '.$data->keterangan.'<a>';
                            }
                        })
                        ->addColumn('cabang', function ($data) {
                            return $data->cabang->name;
                        })
                        ->addColumn('program', function ($data) {
                            return $data->program->name;
                        })
                ->rawColumns(['cabang','program','peserta'])
                ->make(true);
            }
        }
    }

    public function daftar_peserta_diklat_menunggu_konfirmasi(Request $request, $slug_diklat)
    {
        $diklat = Pelatihan::where('slug',$slug_diklat)->first();
        return view('tilawatipusat.konfirmasi.peserta',compact('diklat'));
    }

    public function data_peserta_diklat_menunggu_konfirmasi(Request $request, $diklat_id)
    {
        if(request()->ajax())
        {
            
                $data   = Peserta::where('pelatihan_id', $diklat_id)->where('status',0)->with('kabupaten')->with('pelatihan')->with('filepeserta');
                return DataTables::of($data)
                    ->addColumn('registrasi', function ($data) {
                        if ($data->filepeserta->count()==0) {
                            # code...
                            return '<span class="badge badge-danger">kosong</span>';
                        } else {
                            # code...
                            foreach ($data->filepeserta as $key => $value) {
                                # code...
                                if ($value->status == 0) {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: rgb(112, 150, 255)" data-toggle="modal" data-target="#modal_file"
                                    data-file="'.asset('file_peserta/'.$value->file).'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                } elseif ($value->status == 1) {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: red" data-toggle="modal" data-target="#modal_file"
                                    data-file="'.asset('file_peserta/'.$value->file).'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                } else{
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: lightgreen" data-toggle="modal" data-target="#modal_file"
                                    data-file="'.asset('file_peserta/'.$value->file).'"
                                    data-name="'.$data->name.'"
                                    data-img_name="'.$value->registrasi->name.'"
                                    data-jenis="'.$value->registrasi->jenis.'">'.$value->registrasi->name.'</a>';
                                }
                            
                            }
                            return implode(" - ", $x);
                        }
                    })
                        ->addColumn('kabupaten', function ($data) {
                            return $data->kabupaten->nama;
                        })

                        ->addColumn('status', function ($data) {
                            if ($data->status == 0) {
                                # code...
                                $stat = '<span class="badge badge-warning">menunggu</span>';
                                return $stat;
                            }elseif ($data->status == 1) {
                                # code...
                                $stat = '<span class="badge badge-warning">ditolak</span>';
                                return $stat;
                            } 
                            else {
                                # code...
                                $stat = '<span class="badge badge-success">disetujui</span>';
                                return $stat;
                            }
                        })
                        
                        ->addColumn('action', function($data){
                            $actionBtn = ' <a style="width:50px" href="#" data-id="'.$data->id.'" data-toggle="modal" data-target="#hapusData" class="btn btn-sm btn-outline btn-danger "><i class="fa fa-close"></i></a>';
                            $actionBtn .= ' <a style="width:50px" href="/diklat-profile-peserta/'.$data->id.'/'.$data->pelatihan->program->id.'/'.$data->pelatihan->id.'/admin" class="btn btn-sm btn-outline btn-success "><i class="fa fa-check"></i></a>';
                            // $actionBtn .= ' <a href="#" class="btn btn-sm btn-outline btn-success" data-nama_peserta="'.$data->name.'" data-id="'.asset('images/'.$data->id.'qrcode.png').'" data-toggle="modal" data-target=".modal-scan"><i class="mdi mdi-barcode-scan"></i></a>';
                            return $actionBtn;
                        })
                ->rawColumns(['action','kabupaten','registrasi','status'])
                ->make(true);
            
        }
    }
}
