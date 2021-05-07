<?php

namespace App\Http\Controllers;
use App\Models\Kepala;
use DB;
use DataTables;
use Illuminate\Http\Request;

class KepalaController extends Controller
{
    //store cabang
    public function store(Request $request)
    {
        $nik = $request->nik;
        $kepala   =   Kepala::create(
                    [
                    'nik' => $nik,
                    'name' => $request->name, 
                    'tmptlahir' => $request->tmptlahir,
                    'tgllahir' => $request->tgllahir,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi_id,
                    'kabupaten_id' => $request->kabupaten_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'telp' => $request->telp,
                    'gender' => $request->gender,
                    'pekerjaan' => $request->pekerjaan,
                    'pendidikanter' => $request->pendidikanter,
                    'tahunlulus'=>$request->tahunlulus
                    ]);    
                         
        return Response()->json([
            $kepala,
            $request->nik,
            'success'=>'Kepala Cabang Baru Berhasil disimpan'
        ]);
    }
    //store lembaga
    public function storekep(Request $request)
    {
        $kepala   =   Kepala::updateOrCreate(
            [
            'nik' => $request->nik,
            'name' => $request->name, 
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'gender' => $request->gender,
            'pendidikanter' => $request->pendidikanter,
            'tahunlulus'=>$request->tahunlulus
            ]);    
                 
            return Response()->json([
                $kepala,
                'success'=>'Kepala Lembaga Baru Berhasil disimpan'
            ]);
    }

    public function view(Request $request)
    {
        if(request()->ajax())
        {
            $data = Kepala::orderBy('id','desc')->where('cabang_id',null)->where('lembaga_id', null);
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('pilih', function($row){
                            $btn = '<input type="radio" name="pilih" id="pilih" onclick="pilih()" value="'.$row->id.'" required>';
                            return $btn;
                        })
                        ->rawColumns(['pilih'])
                        ->make(true);
                return datatables()->of($data)->make(true);
        }
    }
}
