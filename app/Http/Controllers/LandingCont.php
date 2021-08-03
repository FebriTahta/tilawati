<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Certificate;
use DataTables;
use Excel;
use App\Imports\EsertifikatImport;
use Illuminate\Http\Request;

class LandingCont extends Controller
{
    public function index(Request $request)
    {
        $diklat = Pelatihan::all();
        return view('tilawatipusat.landing.index',compact('diklat'));
    }

    public function daftar_esertifikat(Request $request, $slug_diklat)
    {
        $diklat = Pelatihan::where('slug',$slug_diklat)->first();
        return $diklat;
        return view('tilawatipusat.landing.daftar_esertifikat',compact('diklat'));
    }

    public function daftar_esertifikat_peserta(Request $request)
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
        $pelatihan = Pelatihan::find($id);
        $data = Excel::queueImport(new EsertifikatImport($id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'E-Sertifikat Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function tes($diklat_id,$slug_program)
    {
        $program= Program::where('slug',$slug_program)->first(); 
        $diklat = Pelatihan::where('id',$diklat_id)->first();
        return view('tilawatipusat.landing.daftar_esertifikat',compact('diklat','program'));
    }

    public function ecertificate($slug_diklat)
    {
        $diklat = Pelatihan::where('slug',$slug_diklat)->first();
        return view('tilawatipusat.landing.daftar_esertifikat',compact('diklat'));
    }

    public function ecertificate_data($diklat_id)
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
}
