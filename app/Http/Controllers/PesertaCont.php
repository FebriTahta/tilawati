<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaCont extends Controller
{
    public function index($id)
    {
        return view('tilawatipusat.peserta.index');
    }

    public function peserta_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Pelatihan::with('cabang','program');
            return DataTables::of($data)
                    ->addColumn('cabang', function ($data) {
                        return $data->cabang->name;
                    })
                    ->addColumn('program', function ($data) {
                        return $data->program->name;
                    })
                    ->addColumn('action', function($data){
                        // $actionBtn = '<input type="radio" name="pilih" id="pilih" onclick="pilih()" value="'.$row->id.'" required>';
                        $actionBtn = '<a href="/diklat-peserta/'.$data->id.'" class="btn btn-sm btn-outline btn-success fa fa-pencil-square">Tambah Peserta</a>';
                        return $actionBtn;
                    })
            ->rawColumns(['cabang','program','action'])
            ->make(true);
        }
    }

    public function peserta_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('pesertas')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('pesertas')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
