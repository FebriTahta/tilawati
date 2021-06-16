<?php

namespace App\Http\Controllers;
use App\Models\Pelatihan;
use App\Models\Program;
use DB;
use App\Models\Cabang;
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
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Cabang::select('id','name','kode')
            		->where('name','LIKE','%' .$search . '%')
                    ->orWhere('kode', 'LIKE', '%' .$search . '%')
            		->get();
        }else{
            $data = Cabang::select('id','name','kode')->get();
        }
        return response()->json($data);
    }

    public function diklat_cabang_select_id($name)
    {
        $data = Cabang::where('name', $name)->select('id')->first();
        return response()->json($data,200);
    }

    public function create(Request $request)
    {
        $dt_program = Program::all();
        return view('tilawatipusat.diklat.create',compact('dt_program'));
    }

    public function store(Request $request)
    {
        Pelatihan::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'cabang_id' => $request->cabang_id,
                'program_id' => $request->program_id,
                'tanggal' => $request->tanggal,
                'name' => $request->name,
                'tempat' => $request->tempat,
                'keterangan' => $request->keterangan,
            ]
        );
      
        return response()->json(
            [
              'success' => 'Diklat Baru Berhasil Dibuat',
              'message' => 'Diklat Baru Berhasil Dibuat'
            ]
        );
    }
}
