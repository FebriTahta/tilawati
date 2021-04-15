<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Cabang;
use App\Models\Program;
use App\Models\Pelatihan;
use DB;
use Illuminate\Http\Request;

class SubController extends Controller
{
    public function fetch($id){
        $kota = Kota::where("propinsi_id",$id)->pluck('name','id');
        return json_encode($kota);
    }

    public function fetchpp($id){
        $pelatihan = Pelatihan::where("program_id", $id)->get();
        return json_encode($pelatihan);
    }

    public function hapuscabang(Request $request)
    {
        $id = $request->id;
        $cb = Cabang::find($id);
        $ncb= $cb->name;
        $cb->delete();
        return redirect()->back()->with('danger', 'Cabang ( '.$ncb.' ) Telah Dihapus Dari Sistem');
    }
}
