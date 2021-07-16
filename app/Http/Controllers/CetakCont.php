<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Peserta;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakCont extends Controller
{
    public function depan_guru()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('tilawatipusat.cetak.depan.index',compact('dt_pel','dt_pro'));
    }

    public function belakang(){
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('tilawatipusat.cetak.belakang.index',compact('dt_pel','dt_pro'));
    }

    public function detail_peserta(Request $request)
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('tilawatipusat.cetak.detail.index',compact('dt_pel','dt_pro'));
    }

    public function cetak_depan(Request $request)
    {
        $id         = $request->pelatihan_id;
        $pelatihan  = Pelatihan::find($id);
        $cabang     = $pelatihan->cabang->kabupaten->nama;
        $kabupaten  = substr($cabang, 5);
        // $peserta    = Peserta::where('pelatihan_id', $id)
        //                   ->where('bersyahadah', 1)->where('kriteria','<>','')->get();
        $peserta    = Peserta::where('pelatihan_id', $id)->where('kriteria','<>','')->get();
        $customPaper = array(0,0,792,612);
        if ($cabang == 'KOTA SURABAYA') {
            # code...
            $direktur   = "Dr. KH. Umar Jaeni M.Pd";
            $jabatan    = "Direktur Eksekutif";
            $kepala     = $jabatan;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
            return $pdf->download('ijazah-depan-peserta-pdf_'.$pelatihan->name.'.pdf','I');
        }else{
            $jabatan    = "Kacab. ".strtolower($kabupaten);
            $kepala     = ucwords($jabatan);
            $direktur   = $pelatihan->cabang->kepala->name;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
            return $pdf->download('ijazah-depan-peserta-_'.$pelatihan->name.'.pdf','I');
        }
    }

    public function cetak_belakang(Request $request){
        $id = $request->pelatihan_id;
        $pelatihan = Pelatihan::find($id);        
        $peserta    = Peserta::where('pelatihan_id', $id)->where('kriteria','<>','')->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_guru',compact('peserta','pelatihan'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('ijazah-belakang-peserta-_'.$pelatihan->name.'.pdf','I');
    }

    public function cetak_detail_peserta(Request $request)
    {
        $id = $request->pelatihan_id;
        $pelatihan = Pelatihan::where('id',$id)->with('program','cabang')->first();        
        $peserta    = Peserta::where('pelatihan_id', $id)->get();
    	$pdf = PDF::loadview('tilawatipusat.cetak.detail.cetak_detail',compact('peserta','pelatihan'))->setPaper('a4', 'portrait');
        // $pdf->setBasePath($webRoot);
    	return $pdf->download('detail-peserta-_'.$pelatihan->name.'.pdf');
    }

}
