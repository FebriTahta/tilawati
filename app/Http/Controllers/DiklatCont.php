<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Program;
use DB;
use DataTables;
use Illuminate\Http\Request;

class DiklatCont extends Controller
{
    public function index(Request $request)
    {
        $dt_program = Program::all();
        return view('tilawatipusat.diklat.index',compact('dt_program'));
    }

    public function diklat_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Pelatihan::all();
            return DataTables::of($data)
            ->make(true);
        }
    }

    public function diklat_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pelatihans')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pelatihans')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function diklat_cabang_select(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $cabangs = Cabang::orderby('name','asc')->select('kode','name')->limit(5)->get();
        }else{
            $cabangs = Cabang::orderby('name','asc')->select('kode','name')->where('name', 'like', '%' .$search . '%')->limit(10)->get();
        }

        $response = array();
        foreach($cabangs as $cabang){
            $response[] = array(
                "kode"=>$cabang->kode,
                "name"=>$cabang->name
            );
        }
        return response()->json($response); 
    }
}
