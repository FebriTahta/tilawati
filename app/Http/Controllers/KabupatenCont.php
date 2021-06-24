<?php

namespace App\Http\Controllers;
use App\Models\Kabupaten;
use DB;
use DataTables;
use Illuminate\Http\Request;

class KabupatenCont extends Controller
{
    public function data_kabupaten(Request $request)
    {
        if(request()->ajax())
        {
            $data   = Cabang::with('provinsi','kabupaten','kepala');
            return DataTables::of($data)
            ->addColumn('provinsi', function ($data) {
                return $data->provinsi->nama;
            })
            ->addColumn('kabupaten', function ($data) {
                return $data->kabupaten->nama;
            })
            ->addColumn('kepala', function($data){
                return $data->kepala->name;
            })
            ->rawColumns(['provinsi','kabupaten','kepala'])
            ->make(true);
        }
    }
}
