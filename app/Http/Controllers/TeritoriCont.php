<?php

namespace App\Http\Controllers;
use App\Models\Cabang;
use DB;
use Illuminate\Http\Request;

class TeritoriCont extends Controller
{
    public function cabang_duplikat_kabupaten()
    {
        if(!empty($request->dari))
        {
        }else{
            $x = DB::select('SELECT kabupaten_id, COUNT(*) duplikat FROM cabangs GROUP BY kabupaten_id HAVING COUNT(duplikat) > 1');
            foreach ($x as $key => $result) {
                # code...
                $y = $result->kabupaten_id;
                $data = Cabang::select('*')->where('kabupaten_id',$y)->get();            
            }
            return response()->json($data,200);
        }
        
    }
}
