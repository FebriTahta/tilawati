<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Apicabangtilawati;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Helpers\ApiFormatter;

class ApiCont extends Controller
{
    public function daftar_cabang()
    {
        $data = Cabang::orderBy('kode','ASC')
        ->join('kabupaten','cabangs.kabupaten_id','kabupaten.id')
        ->select('name','status','nama','kepalacabang','alamat','telp')
        ->paginate(10);

        if($data)
        {
            return ApiFormatter::createApi(200, 'success' ,$data);
        }else {
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    public function diklat_online()
    {
        $data = Pelatihan::where('cabang_id',79)
        ->where('pendaftaran', null)->orWhere('pendaftaran','dibuka')
        ->join('flyers','pelatihans.id','flyers.pelatihan_id')
        ->join('programs','pelatihans.program_id','programs.id')
        ->select('pelatihans.slug','programs.name','pelatihans.tanggal','pelatihans.keterangan','pelatihans.jenis','flyers.image')
        ->get();

        if($data)
        {
            return ApiFormatter::createApi(200, 'success' ,$data);
        }else {
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    public function api_cabang_tilawati(Request $request)
    {
        $data = Apicabangtilawati::orderBy('kode','ASC')
        ->join('kabupaten','apicabangtilawatis.kabupaten_id','kabupaten.id')
        ->select('name','status','nama','kepalacabang','alamat','telp')
        ->paginate(10);

        if($data)
        {
            return ApiFormatter::createApi(200, 'success' ,$data);
        }else {
            return ApiFormatter::createApi(400, 'failed');
        }
    }
}
