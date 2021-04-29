<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\City;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Cabang;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Kepala;
use DB;
use Illuminate\Http\Request;

class SubController extends Controller
{
//1-3 daerah    
    public function fetch($id){
        $city = Kabupaten::where("id_prov",$id)->pluck('nama','id_kab');
        return json_encode($city);
    }

    public function fetch2($id){
        $city = Kecamatan::where("id_kab",$id)->pluck('nama','id_kec');
        return json_encode($city);
    }

    public function fetch3($id){
        $city = Kelurahan::where("id_kec",$id)->pluck('nama','id_kel');
        return json_encode($city);
    }
//nama kepala
    public function fetch4($id)
    {
        $data = Kepala::find($id);
        return json_encode($data);
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
