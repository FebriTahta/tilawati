<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function ijazahdepan()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('AdmPelatihan.Cetak.depan',compact('dt_pel','dt_pro'));
    }

    public function ijazahbelakangsantri()
    {
        $dt_pel = Pelatihan::orderBy('id', 'desc')->get();
        return view('AdmPelatihan.Cetak.belakang_santri', compact('dt_pel'));
    }

    public function cetak_depan(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-depan-peserta-pdf');
    }

    public function cetak_belakang_santri(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_santri',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-santri-pdf');
    }
}
