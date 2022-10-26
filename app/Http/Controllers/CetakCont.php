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
        $dt_pro = Program::where('status',1)->get();
        return view('tilawatipusat.cetak.depan.index',compact('dt_pel','dt_pro'));
    }

    public function depan_guru_lama()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::where('status',1)->get();
        return view('tilawatipusat.cetak.depan.index2',compact('dt_pel','dt_pro'));
    }

    public function belakang(){
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::where('status',1)->get();
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
        $pelatihan_id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $request->pelatihan_id)->get();
        return view('tilawatipusat.cetak.proses.cek_qr',compact('peserta','pelatihan_id'));
    }

    public function cetak_syahadah_depan_b5(Request $request)
    {
        $customPaper = array(0,0,865,612);
    	$pdf = PDF::loadView('tilawatipusat.cetak.syahadah_b5.depan')->setPaper($customPaper, 'portrait');
    	return $pdf->stream('syahadah.pdf','I');
        
    }

    public function tampilan()
    {
        return view('tilawatipusat.cetak.syahadah_b5.depan');
    }

    public function cetak_depan_syahadah(Request $request)
    {
        $id         = $request->pelatihan_id;
        $pelatihan  = Pelatihan::find($id);
        $cabang     = $pelatihan->cabang->kabupaten->nama;
        $kabupaten  = substr($cabang, 5);
        $peserta    = Peserta::where('pelatihan_id', $id)->where('bersyahadah','1')->get();
        $customPaper = array(0,0,792,612);
        if ($pelatihan->cabang->name == 'Cahaya Amanah' || $pelatihan->cabang->name == 'Tilawati Pusat' || substr($pelatihan->cabang->name,0,3) == 'RPQ') {
            # code...
            $direktur   = "Dr. KH. Umar Jaeni, M.Pd";
            $jabatan    = "Direktur Eksekutif";
            $kepala     = $jabatan;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
            return $pdf->download('ijazah-depan-peserta-pdf_'.$pelatihan->name.'.pdf','I');
        }else{
            $jumlah_cabang = $pelatihan->cabang->kabupaten->cabang->count();
            if ($jumlah_cabang > 1) {
                # code...
                if (substr($pelatihan->cabang->kabupaten->nama,5,3)=='ADM') {
                    # code...
                    $jabatan     = 'Kacab. '.strtoupper(substr($pelatihan->cabang->kabupaten->provinsi->nama,0,3)).' '.ucfirst(substr($pelatihan->cabang->kabupaten->provinsi->nama,4));
                } else {
                    # code...
                    if ($pelatihan->cabang->name == 'Tilawati Gresik Al Hikmah') {
                        # code...
                        $jabatan     = 'Kacab. Al Hikmah '.strtolower($kabupaten);
                    }elseif ($pelatihan->cabang->name == 'Tilawati Citra Anak Sholeh') {
                        # code...
                        $jabatan     = 'Kacab. CAS Surabaya Jawa Timur';
                    }
                    else {
                        # code...
                        $jabatan     = 'Kacab. '.ucwords($pelatihan->cabang->name).' '.strtolower($pelatihan->cabang->kabupaten->provinsi->nama);
                    }
                }
            }else {
                # code...
                if (substr($pelatihan->cabang->kabupaten->nama,5,3)=='ADM') {
                    # code...
                    $jabatan     = 'Kacab. '.strtoupper(substr($pelatihan->cabang->kabupaten->provinsi->nama,0,3)).' '.ucfirst(substr($pelatihan->cabang->kabupaten->provinsi->nama,4));
                }else {
                    # code...
                    if ($pelatihan->cabang->name == 'Tilawati Gresik Al Hikmah') {
                        $jabatan     = 'Kacab. Al Hikmah '.strtolower($kabupaten);
                    }elseif ($pelatihan->cabang->name == 'Tilawati Citra Anak Sholeh') {
                        # code...
                        $jabatan     = 'Kacab. CAS Surabaya Jawa Timur';
                    }else{
                        $jabatan     = 'Kacab. '.strtolower($kabupaten).' '.strtolower($pelatihan->cabang->kabupaten->provinsi->nama);
                    }
                }
            }
  
            $kepala     = ucwords($jabatan);
            if ($pelatihan->cabang->kepala == null) {
                # code...
                return Redirect::back()->withFail('Tidak ada Kepala Cabang yang terdaftar pada Cabang - '.$pelatihan->cabang->name.'');
            } else {
                # code...
                // $direktur   = $pelatihan->cabang->kepala->name;
                $direktur   = $pelatihan->cabang->kepalacabang;
                $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang','pelatihan'))->setPaper($customPaper, 'portrait');
                return $pdf->download('ijazah-depan-peserta-_'.$pelatihan->name.'.pdf','I');
            }
        }
    }



    public function cetak_depan_beberapa(Request $request)
    {
        $peserta_id_array = $request->id;
        $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->where('kriteria','<>','')->get();
        $customPaper    = array(0,0,792,612);
        $pdf            = PDF::loadview('AdmPelatihan.Cetak.cetak_depan_beberapa',compact('peserta'))->setPaper($customPaper, 'portrait');
        return $pdf->download('ijazah-depan-peserta-pdf.pdf','I');
    }

    public function cetak_belakang_beberapa(Request $request)
    {
        $peserta_id_array = $request->id;
        $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->where('bersyahadah',1)->get();
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

    public function cetak_belakang2(Request $request)
    {
        $id = $request->pelatihan_id;
        $pelatihan = Pelatihan::find($id);        
        $peserta    = Peserta::where('pelatihan_id', $id)->where('kriteria','<>','')->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_tot2',compact('peserta','pelatihan'))->setPaper($customPaper, 'portrait');
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

    public function cetak_depan_lama_beberapa(Request $request)
    {
        $peserta_id_array = $request->id;
        $peserta        = Peserta::whereIn('id',explode(",",$peserta_id_array))->where('kriteria','<>','')->get();
        $customPaper    = array(0,0,792,612);
        $pdf            = PDF::loadview('tilawatipusat.cetak.depan.lama',compact('peserta'))->setPaper($customPaper, 'portrait');
        return $pdf->download('ijazah-depan-peserta-pdf.pdf','I'); 
    }

    public function cetak_depan_lama(Request $request)
    {
        $pelatihan_id   = $request->pelatihan_id;
        $peserta        = Peserta::where('pelatihan_id', $pelatihan_id)->where('kriteria','<>','')->where('bersyahadah',1)->get();
        $customPaper    = array(0,0,792,612);
        $pdf            = PDF::loadview('tilawatipusat.cetak.depan.lama2',compact('peserta'))->setPaper($customPaper, 'portrait');
        return $pdf->download('ijazah-depan-peserta-pdf.pdf','I');
    }
}
