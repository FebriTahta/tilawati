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
use App\Models\Provinsi;
use App\Models\Kepala;
use App\Models\Jenjang;
use DB;
use Illuminate\Http\Request;

class SubController extends Controller
{
//1-3 daerah    
    public function fetch($id){
        $city = Kabupaten::where('provinsi_id',$id)->pluck('nama','id');
        return json_encode($city);
    }

    public function fetch2($id){
        $city = Kecamatan::where('kabupaten_id',$id)->pluck('nama','id');
        return json_encode($city);
    }

    public function fetch3($id){
        $city = Kelurahan::where('kecamatan_id',$id)->pluck('nama','id');
        return json_encode($city);
    }
    public function fetch5($id){
        $cb = Cabang::find($id);
        return json_encode($cb);
    }
    public function fetch6($id){
        $cb = Provinsi::find($id);
        return json_encode($cb);
    }
    public function fetch7($id){
        $cb = Kabupaten::find($id);
        return json_encode($cb);
    }

// nama program dari sertifikat
    public function fetchnampro($namaprogram)
    {
        $np = Program::where('name', $namaprogram);
        return json_encode($np);
    }

//nama kepala
    public function fetch4($id)
    {
        $data = Kepala::find($id);
        return json_encode($data);
    }
//nama cabang
    public function fetch8($id)
    {
        $data = Cabang::find($id);
        return json_encode($data);
    }

    public function fetchpp($id){
        $pelatihan = Pelatihan::where("program_id", $id)->with('program','cabang')->orderBy('id','desc')->get();
        return json_encode($pelatihan);
    }

    public function hapuscabang(Request $request)
    {
        $id = $request->id;
        User::where('cabang_id', $id)->delete();
        $cb = Cabang::find($id);
        $ncb= $cb->name;
        $cb->delete();
        return redirect()->back()->with('danger', 'Cabang ( '.$ncb.' ) Telah Dihapus Dari Sistem');
    }

    public function hapusjenjang(Request $request)
    {
        $id = $request->id;
        Jenjang::find($id)->delete();
        return redirect()->back()->with('danger', 'jenjang tersebut telah dihapus');
    }
    //kabupaten
    public function fetch_kabupaten(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kabupaten::select('id','nama')
                    ->where('id','LIKE','%' .$search . '%')
                    ->orWhere('nama', 'LIKE', '%' .$search . '%')
                    ->get();
        }else{
            $data = Kabupaten::select('id','nama')->get();
        }
        return response()->json($data);
    }

}
