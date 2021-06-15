<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class CetakCont extends Controller
{
    public function depan_guru()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('tilawatipusat.cetak.depan.guru',compact('dt_pel','dt_pro'));
    }

    public function depan_santri()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('tilawatipusat.cetak.depan.santri',compact('dt_pel','dt_pro'));
    }
}
