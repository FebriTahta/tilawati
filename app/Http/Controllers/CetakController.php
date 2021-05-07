<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use PDF;
use Mpdf\Mpdf;

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
        $dt_pel = Pelatihan::where('keterangan','SANTRI')->orderBy('id', 'desc')->get();
        return view('AdmPelatihan.Cetak.belakang_santri', compact('dt_pel'));
    }

    public function ijazahbelakangguru()
    {
        $dt_pel = Pelatihan::where('keterangan','GURU')->orderBy('id', 'desc')->get();
        return view('AdmPelatihan.Cetak.belakang_guru', compact('dt_pel'));
    }

    public function cetak_depan(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-depan-peserta-pdf','I');
    }

    public function cetak_belakang_santri(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
        // $customPaper = array(0,0,842.4,597.6);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_guru',compact('peserta'))->setPaper($customPaper, 'landscape');
    	return $pdf->download('cetak-laporan-ijazah-belakang-guru-pdf');
    }

    public function cetak_belakang_guru(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_guru',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-guru-pdf');
    }
}
