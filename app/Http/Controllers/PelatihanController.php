<?php

namespace App\Http\Controllers;
use App\Models\Cabang;
use App\Models\Program;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use DB;
use DataTables;

class PelatihanController extends Controller
{
    public function index()
    {
        $dt_c = Cabang::all();
        $dt_p = Program::all();
        $dt_pel = Pelatihan::orderBy('id','desc')->get();
        return view('AdmPelatihan.Pelatihan.index',compact('dt_pel','dt_c','dt_p'));
    }

    public function store(Request $request)
    {
        try {
            //code...
            $dt_pel = new Pelatihan;
            $dt_pel->tanggal = $request->tanggal;
            $dt_pel->cabang_id = $request->cabang_id;
            $dt_pel->nomer = $request->nomer;
            $dt_pel->program_id = $request->program_id;
            $dt_pel->name = $request->name;
            $dt_pel->tempat = $request->tempat;
            $dt_pel->keterangan = $request->keterangan;
            $dt_pel->save();

            return redirect()->back()->with('success','Pelatihan Baru Berhasil Ditambahkan');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fetchdatacabang(Request $request)
    {
        if ($request->ajax()) {
            $data = Cabang::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<input type="radio" name="pilih" id="pilih" onclick="pilih()" value="'.$row->id.'" required>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
