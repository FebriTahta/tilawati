<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Program;
use App\Models\Penilaian;
use DataTables;
use App\Models\Kabupaten;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProgramCont extends Controller
{
    public function index(Request $request)
    {

        return view('tilawatipusat.program.index');
    }

    public function program_data(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Program::with('penilaian')->where('status',1)->get();
                return DataTables::of($data)
                    ->addColumn('penilaian', function ($data) {
                        if ($data->penilaian->count()==0) {
                            # code...
                            return '<span class="badge badge-danger">kosong</span>';
                        } else {
                            # code...
                            foreach ($data->penilaian as $key => $value) {
                                # code...
                                if ($value->kategori == 'skill') {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class="text-white badge" style="background-color: rgb(112, 150, 255)" data-toggle="modal" data-target=".bs-example-modal-penilaian-update"
                                    data-id="'.$value->id.'" 
                                    data-program_id="'.$value->program_id.'"
                                    data-name="'.$value->name.'"
                                    data-min="'.$value->min.'"
                                    data-max="'.$value->max.'"
                                    data-kategori="'.$value->kategori.'">'.$value->name.'</a>';
                                } else {
                                    # code...
                                    $x[] = 
                                    '<a href="#" class=" badge badge-success" data-toggle="modal" data-target=".bs-example-modal-penilaian-update"
                                    data-id="'.$value->id.'" 
                                    data-program_id="'.$value->program_id.'"
                                    data-name="'.$value->name.'"
                                    data-min="'.$value->min.'"
                                    data-max="'.$value->max.'"
                                    data-kategori="'.$value->kategori.'">'.$value->name.'</a>';
                                }
                                
                            }
                            return implode(" - ", $x);
                        }
                    })
                    ->addColumn('option', function ($data) {
                        $btn = ' <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bs-example-modal-kategori"
                        data-id="'.$data->id.'"><i class="fa fa-plus"></i> kategori</button>';
                        $btn .= ' <button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-program-update"
                        data-id="'.$data->id.'" data-name="'.$data->name.'"><i class="mdi mdi-pencil-outline"></i></button>';
                        $btn .= ' <button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bs-example-modal-program-hapus"
                        data-id="'.$data->id.'"><i class="fa fa-trash"></i> </button>';
                        return $btn;
                    })
                ->rawColumns(['penilaian','option'])
                ->make(true);
        }
    }

    public function program_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('programs')->where('status',1)
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('programs')->where('status',1)
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }

    public function store(Request $request){
        Program::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => 1,
            ]
        );
        return response()->json(
            [
              'success' => 'Program Baru Berhasil Ditambahkan!',
              'message' => 'Program Baru Berhasil Ditambahkan!'
            ]
        );
    }

    public function delete(Request $request){
        $id = $request->id;
        Program::find($id)->delete();

        return response()->json(
            [
              'success' => 'Program Berhasil Dihapus!',
              'message' => 'Program Berhasil Dihapus!'
            ]
        );
    }
}
