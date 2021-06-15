<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Program;
use DataTables;
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
            $data   = Program::all();
            return DataTables::of($data)
            ->make(true);
        }
    }

    public function program_total(Request $request)
    {
        if (request()->ajax()) {
            # code...
            if(!empty($request->dari))
            {
                $data = DB::table('programs')
                ->whereBetween('created_at', array($request->dari, $request->sampai))
                ->get()->count();
                return response()->json($data,200);
            }
            else
            {
                $data = DB::table('programs')
                ->get()->count();
                return response()->json($data,200);
            }
        }
    }
}
