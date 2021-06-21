<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\PesertaImport;
use App\Imports\PesertaGuruImport;
use App\Imports\PesertaToTImport;
use App\Imports\PesertaTahfidzImport;
use App\Imports\PesertaMunaqisyImport;
use App\Imports\CabangImport;
use App\Imports\LembagaImport;
use App\Imports\RpqImport;
use App\Imports\PesertaDiklatImport;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    public function importPeserta(Request $request)
    {
        $id = $request->id ;
        $tanggal = $request->tanggal;
        $data = Excel::import(new PesertaImport($id, $tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }
    //new
    public function importPesertaDiklat(Request $request)
    {
        $id = $request->id ;
        $tanggal = $request->tanggal;
        $data = Excel::import(new PesertaDiklatImport($id, $tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importPesertaGuru(Request $request)
    {
        $id = $request->id;
        $tanggal = $request->tanggal;
        $data = Excel::queueImport(new PesertaGuruImport($id,$tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importPesertaToT(Request $request)
    {
        $id = $request->id;
        $tanggal = $request->tanggal;
        $data = Excel::queueImport(new PesertaToTImport($id, $tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importPesertaTahfidz(Request $request)
    {
        $id = $request->id;
        $tanggal = $request->tanggal;
        $data = Excel::queueImport(new PesertaTahfidzImport($id, $tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Tahfidz Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importPesertaMunaqisy(Request $request)
    {
        $id = $request->id;
        $tanggal = $request->tanggal;
        $data = Excel::queueImport(new PesertaMunaqisyImport($id, $tanggal), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Munaqisy Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importCabang(Request $request)
    {
        $data = Excel::queueImport(new CabangImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Cabang Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importRpq(Request $request)
    {
        $data = Excel::queueImport(new RpqImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Rpq Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importLembaga(Request $request)
    {
        $data = Excel::queueImport(new LembagaImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Lembaga Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

}
