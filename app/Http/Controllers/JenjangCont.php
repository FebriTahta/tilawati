<?php

namespace App\Http\Controllers;
use DB;
Use App\Models\Jenjang;
use DataTables;
use Illuminate\Http\Request;

class JenjangCont extends Controller
{
    public function index(Request $request)
    {
        return view('tilawatipusat.jenjang.index');
    }

    public function jenjang_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Jenjang::all();
            return DataTables::of($data)
            ->addColumn('option', function ($data) {
                $btn = ' <button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-jenjang-update"
                data-id="'.$data->id.'" data-name="'.$data->name.'"><i class="mdi mdi-pencil-outline"></i></button>';
                $btn .= ' <button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-jenjang-hapus"
                data-id="'.$data->id.'"><i class="fa fa-trash"></i> </button>';
                return $btn;
            })
            ->rawColumns(['option'])
            ->make(true);
        }
    }

    public function jenjang_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('jenjangs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('jenjangs')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function store(Request $request)
    {
        Jenjang::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name' => $request->name,
            ]
        );
      
        return response()->json(
            [
              'success' => 'Jenjang Baru Berhasil Ditambahkan!',
              'message' => 'Jenjang Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete(Request $request){
        $id = $request->id;
        Jenjang::find($id)->delete();
        return response()->json(
            [
              'success' => 'Jenjang Tersebut Berhasil Dihapus!',
              'message' => 'Jenjang Tersebut Berhasil Dihapus!'
            ]
        );
    }
}
