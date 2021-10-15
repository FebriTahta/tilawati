<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Peserta;
use PDF;
use Redirect;
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
        $peserta    = Peserta::where('pelatihan_id', $id)->where('kriteria','<>','')->get();
        $customPaper = array(0,0,792,612);
        if ($pelatihan->cabang->name == 'Cahaya Amanah' || $pelatihan->cabang->name == 'Tilawati Pusat') {
            # code...
            $direktur   = "Dr. KH. Umar Jaeni M.Pd";
            $jabatan    = "Direktur Eksekutif";
            $kepala     = $jabatan;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
            return $pdf->download('ijazah-depan-peserta-pdf_'.$pelatihan->name.'.pdf','I');
        }else{
            $jabatan    = "Kacab. ".strtolower($kabupaten);
            $kepala     = ucwords($jabatan);
            if ($pelatihan->cabang->kepala == null) {
                # code...
                return Redirect::back()->withFail('Tidak ada Kepala Cabang yang terdaftar pada Cabang - '.$pelatihan->cabang->name.'');
            } else {
                # code...
                $direktur   = $pelatihan->cabang->kepala->name;
                $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
                return $pdf->download('ijazah-depan-peserta-_'.$pelatihan->name.'.pdf','I');
            }
        }
    }

    public function cetak_depan_beberapa(Request $request)
    {
        $peserta_id_array = $request->id;
        $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->get();
        $customPaper    = array(0,0,792,612);
        $pdf            = PDF::loadview('AdmPelatihan.Cetak.cetak_depan_beberapa',compact('peserta'))->setPaper($customPaper, 'portrait');
        return $pdf->download('ijazah-depan-peserta-pdf.pdf','I');
    }

    public function cetak_belakang_beberapa(Request $request)
    {
        $peserta_id_array = $request->id;
        $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_beberapa',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('ijazah-belakang-peserta.pdf','I');
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
        $pelatihan  = Pelatihan::where('id',$id)->with('program','cabang')->first();        
        $peserta    = Peserta::where('pelatihan_id', $id)->get();
    	$pdf        = PDF::loadview('tilawatipusat.cetak.detail.cetak_detail',compact('peserta','pelatihan'))->setPaper('a4', 'portrait');
    	return $pdf->download('detail-peserta-_'.$pelatihan->name.'.pdf');
    }

    public function cetak_surat_pengiriman(Request $request)
    {
        $id = $request->id;
        $pelatihan  = Pelatihan::where('id',$id)->with('program')->first();
        $peserta    = Peserta::where('pelatihan_id',$id)->where('status',1)->get();
        $pdf        = PDF::loadview('tilawatipusat.cetak.detail.surat_pengiriman',compact('peserta','pelatihan'))->setpaper('A4','portrait');
        return $pdf->download('surat-pengiriman-'.$pelatihan->program->name.'-'.Carbon::parse($pelatihan->tanggal)->isoFormat('D-MMMM-Y').'.pdf');
    }

    public function cetak_surat_pengiriman_satu(Request $request)
    {
        $id     = $request->id;
        $peserta= Peserta::find($id);
        $pdf    = PDF::loadview('tilawatipusat.cetak.detail.surat_pengiriman_satu',compact('peserta'))->setpaper('A4','portrait');
        return $pdf->download('surat-pengiriman-'.$peserta->name.'-'.Carbon::parse($peserta->tanggal)->isoFormat('D-MMMM-Y').'.pdf');
    }

    public function cetak_surat_pengiriman_beberapa(Request $request)
    {
        
        $peserta_id_array = $request->idcetaksurats;
        $peserta= Peserta::whereIn('id',explode(",",$peserta_id_array))->get();
        $pdf    = PDF::loadview('tilawatipusat.cetak.detail.surat_pengiriman',compact('peserta'))->setpaper('A4','portrait');
        return $pdf->download('surat-pengiriman.pdf');
        
    }

    public function cetak_syahadah_depan_perseorangan(Request $request, $peserta_id)
    {
        
    }


}
