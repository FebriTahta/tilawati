<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\Models\Cabang;

class TTDController extends Controller
{
    public function data_ttd(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = Cabang::where('ttd', '!=' ,null)->get();
                return DataTables::of($data)
                    ->addColumn('image_ttd', function ($data) {
                        return 'x';
                    })
                    ->addColumn('status_ttd', function ($data) {
                        return 'x';
                    })
                ->rawColumns(['image_ttd','status_ttd'])
            ->make(true);
        }
        
        return view();
    }
}
