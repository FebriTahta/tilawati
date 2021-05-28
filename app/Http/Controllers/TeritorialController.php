<?php

namespace App\Http\Controllers;
use App\Models\Teritorial;
use DataTables;
use Illuminate\Http\Request;

class TeritorialController extends Controller
{
    public function index()
    {
        return view('AdmPelatihan.Teritorial.index');
    }

    public function get(Request $request)
    {
        if(request()->ajax())
        {
            $data = Teritorial::all();
                return Datatables::of($data)
                        ->addIndexColumn()
                        // ->addColumn('Actions', function($row){
                        //     $btn = '<button type="button" data-toggle="modal" data-target="#formuserini" data-id="'.$row->id.'" data-id2="'.$row->name.'" class="btn btn-danger waves-effect waves-light "> <i class="fa fa-trash"></i> Hapus </button>';
                        //     return $btn;
                        // })
                        // ->rawColumns(['Actions'])
                        ->make(true);
                return datatables()->of($data)->make(true);
        }
    }

    public function store(Request $request)
    {
        
    }
}
