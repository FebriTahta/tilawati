<?php

namespace App\Http\Controllers;
use App\Models\Negara;
use App\Models\Kabupaten;
use App\Models\Phonegara;
use App\Imports\PhoneCodeImport;
use App\Imports\PhoneCodeLogatIndoImport;
use Excel;
use Illuminate\Http\Request;
use DataTables;
class KodeAdminCont extends Controller
{
    public function page_negara()
    {
        $negara = Negara::all()->count();
        return view('tilawatipusat.kode_administrasi.negara',compact('negara'));
    }

    public function page_phone()
    {
        $phone  = Phonegara::all()->count();
        return view('tilawatipusat.kode_administrasi.phone',compact('phone'));
    }

    public function page_kabupaten()
    {
        $kabupaten = Kabupaten::all()->count();
        return view('tilawatipusat.kode_administrasi.kabupaten',compact('kabupaten'));
    }

    public function data_negara(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Negara::orderBy('country_name','asc')->with('phonegara');
            return DataTables::of($data)
            ->addColumn('code', function ($data) {
                if ($data->phonegara == null) {
                    # code...
                    return 'kosong';
                }else{
                    return $data->phonegara->phonecode;
                }
            })
            ->rawColumns(['code'])
            ->make(true);
        }
    }

    public function data_phonecode(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Phonegara::orderBy('country_name','asc');
            return DataTables::of($data)
            ->make(true);
        }
    }

    public function data_kabupaten(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Kabupaten::with('provinsi');
            return DataTables::of($data)
                    ->addColumn('provinsi', function ($data) {
                        return $data->provinsi->nama;  
                    })
                    ->rawColumns(['provinsi'])
                    ->addColumn('provinsi_id', function ($data) {
                        return $data->provinsi->id;  
                    })
                    ->rawColumns(['provinsi','provinsi_id'])
            ->make(true);
        }
    }

    public function import_kode(Request $request)
    {
        $data = Excel::import(new PhoneCodeImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Country Phone Code berhasil diimport'
        ]);
    }

    public function import_kode2(Request $request)
    {
        $data = Excel::import(new PhoneCodeLogatIndoImport(), $request->file('file'));
        return Response()->json([
            $data,
            'success'=>'Country Phone Code berhasil diimport'
        ]);
    }
}
