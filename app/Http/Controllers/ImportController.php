<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\PesertaImport;
use App\Imports\TrainerImport;
use App\Imports\KpaImport;
use App\Imports\PesertaGuruImport;
use App\Imports\PesertaToTImport;
use App\Imports\PesertaTahfidzImport;
use App\Imports\PesertaMunaqisyImport;
use App\Imports\CabangImport;
use App\Imports\ApicabangtilawatiImport;
use App\Imports\ApicabangnfImport;
use App\Imports\LembagaImport;
use App\Imports\RpqImport;
use App\Imports\PesertaDiklatImport;
use App\Imports\PesertaDiklatImport2;
use App\Imports\MunaqisyImport;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    public function importPeserta(Request $request)
    {
        $pelatihan = Pelatihan::find($request->id);
        $cabang_id = $pelatihan->cabang_id;
        
        $id = $request->id ;
        $tanggal = $request->tanggal;
        $data = Excel::import(new PesertaImport($id, $tanggal, $cabang_id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
    }
    //new
    public function importPesertaDiklat(Request $request)
    {
        $id = $request->id ;
        $pelatihan = Pelatihan::find($id);
        $cabang_id = $pelatihan->cabang_id;
        $tanggal = $request->tanggal;
        $data = Excel::queueImport(new PesertaDiklatImport($id, $tanggal, $cabang_id), $request->file('file'));
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

    public function importapicabangtilawati(Request $request)
    {
        $data = Excel::import(new ApicabangtilawatiImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Cabang Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importapicabangnf(Request $request)
    {
        $data = Excel::import(new ApicabangnfImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Cabang Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importTrainer(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        $data = Excel::import(new TrainerImport($cabang_id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Import Ok'
        ]);
    }

    public function importKpa(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        $data = Excel::import(new KpaImport($cabang_id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Import Ok'
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
        $cabang_id = auth()->user()->cabang->id;
        $data = Excel::import(new LembagaImport($cabang_id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Lembaga Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function importMunaqisy(Request $request)
    {
        $cabang_id = auth()->user()->cabang->id;
        $data = Excel::import(new MunaqisyImport($cabang_id), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Data Munaqisy Berhasil Ditambahkan Melalui file Excel'
        ]);
    }

    public function import_peserta_diklat2(Request $request)
    {
        $id = $request->id ;
        $pelatihan = Pelatihan::find($id);
        $cabang_id = $pelatihan->cabang_id;
        $tanggal = $request->tanggal;
        $data = Excel::import(new PesertaDiklatImport2($id, $tanggal, $cabang_id), $request->file('file'));
        
        if(request()->ajax())
        {
        return Response()->json([
            $data,
            'success'=>'Peserta Berhasil Ditambahkan Melalui file Excel'
        ]);
        }else {
            # code...
            return back()->with('success', 'User Imported Successfully.');
        }
    }

}
