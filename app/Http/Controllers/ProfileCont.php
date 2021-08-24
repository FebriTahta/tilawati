<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use App\Models\Program;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class ProfileCont extends Controller
{
    public function index($id,$id_program,$id_pelatihan)
    {
        $peserta = Peserta::find($id);
        $program = Program::find($id_program);
        $pelatihan= Pelatihan::find($id_pelatihan);
        return view('tilawatipusat.profile.profile_scan_barcode',compact('peserta','program','pelatihan'));
    }

    public function scan($id,$id_program,$id_pelatihan){
        $peserta = Peserta::find($id);
        $program = Program::find($id_program);
        $pelatihan= Pelatihan::find($id_pelatihan);
        return view('tilawatipusat.profile.profile_scan_barcode',compact('peserta','program','pelatihan'));
    }
}
