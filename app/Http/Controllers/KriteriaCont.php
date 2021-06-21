<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Kriteria;
use App\Models\Program;
use DataTables;
use Illuminate\Http\Request;

class KriteriaCont extends Controller
{
    public function index(Request $request)
    {
        $pro = Program::all();
        return view('tilawatipusat.kriteria.index',compact('pro'));
    }

    public function kriteria_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Kriteria::with('program');
            return DataTables::of($data)
            ->addColumn('program',function($data){
                return $data->program->name;
            })
            ->addColumn('option', function ($data) {
                $btn = ' <button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-kriteria-update"
                data-id="'.$data->id.'" data-name="'.$data->name.'" data-untuk="'.$data->untuk.'"><i class="mdi mdi-pencil-outline"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-kriteria-hapus"
                data-id="'.$data->id.'"><i class="fa fa-trash"></i> </button>';
                return $btn;
            })
            ->rawColumns(['option','program'])
            ->make(true);
        }
    }

    public function kriteria_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('kriterias')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('kriterias')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function store(Request $request){
        Kriteria::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name' => $request->name,
                'program_id' => $request->program_id,
                'untuk' => $request->untuk,
            ]
        );
      
        return response()->json(
            [
              'success' => 'Kriteria Baru Berhasil Ditambahkan!',
              'message' => 'Kriteria Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete(Request $request){
        $id = $request->id;
        Kriteria::find($id)->delete();
        return response()->json(
            [
              'success' => 'Kriteria Tersebut Berhasil Dihapus!',
              'message' => 'Kriteria Tersebut Berhasil Dihapus!'
            ]
        );

    }
}
