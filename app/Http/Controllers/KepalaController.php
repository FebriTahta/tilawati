<?php

namespace App\Http\Controllers;
use App\Models\Kepala;
use DB;
use DataTables;
use Illuminate\Http\Request;

class KepalaController extends Controller
{
    public function store(Request $request)
    {
 
        $kepala   =   Kepala::updateOrCreate(
                    [
                    'name' => $request->name, 
                    'tmptlahir' => $request->tmptlahir,
                    'tgllahir' => $request->tgllahir,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi_id,
                    'kota_id' => $request->kabupaten_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'kelurahan_id' => $request->kelurahan_id,
                    'telp' => $request->telp,
                    'gender' => $request->gender,
                    'pekerjaan' => $request->pekerjaan
                    ]);    
                         
        return Response()->json($kepala);
    }

    public function view(Request $request)
    {
        if(request()->ajax())
        {
            $data = Kepala::orderBy('id','desc');
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
