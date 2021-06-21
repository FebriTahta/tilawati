<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use PDF;
use Auth;
use Mpdf\Mpdf;

class CetakController extends Controller
{
    public function ijazahdepan()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('AdmPelatihan.Cetak.depan',compact('dt_pel','dt_pro'));
    }

    public function ijazahdepan_s()
    {
        $dt_pel = Pelatihan::all();
        $dt_pro = Program::all();
        return view('AdmPelatihan.Cetak.depan_s',compact('dt_pel','dt_pro'));
    }

    public function ijazahbelakangsantri()
    {
        $dt_pel = Program::where('name','munaqosyah santri')->first();
        return view('AdmPelatihan.Cetak.belakang_santri', compact('dt_pel'));
    }

    public function ijazahbelakangguru()
    {
        $dt_pel = Program::where('name',"standarisasi guru al qur'an")->first();
        return view('AdmPelatihan.Cetak.belakang_guru', compact('dt_pel'));
    }

    public function ijazahbelakangtot()
    {
        $dt_pro = Program::where('name','training of trainer')->first();

        return view('AdmPelatihan.Cetak.belakang_tot', compact('dt_pro'));
    }

    public function ijazahbelakangtahfidz()
    {
        $dt_pro = Program::where('name','tahfidz')->first();
        return view('AdmPelatihan.Cetak.belakang_tahfidz', compact('dt_pro'));
    }

    public function ijazahbelakangtilawah()
    {
        $dt_pro = Program::where('name','tilawah')->first();
        return view('AdmPelatihan.Cetak.belakang_guru', compact('dt_pro'));
    }

    public function ijazahbelakangmunaqisy()
    {   
        $dt_pro = Program::where('name','munaqisy')->first();
        return view('AdmPelatihan.Cetak.belakang_tahfidz', compact('dt_pro'));
    }

    public function cetak_depan(Request $request)
    {
        $id         = $request->pelatihan_id;
        $pelatihan  = Pelatihan::find($id);
        $cabang     = $pelatihan->cabang->kabupaten->nama;
        $kabupaten  = substr($cabang, 5);
        $peserta    = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);

        if ($cabang == 'KOTA SURABAYA') {
            # code...
            $direktur   = "Dr. KH. Umar Jaeni M.Pd";
            $jabatan    = "Direktur Eksekutif";
            $kepala     = $jabatan;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang'))->setPaper($customPaper, 'portrait');
            return $pdf->download('cetak-laporan-ijazah-depan-peserta-pdf','I');
        }else{
            $jabatan    = "Kacab. ".strtolower($kabupaten);
            $kepala     = ucwords($jabatan);
            $direktur   = $pelatihan->cabang->kepala->name;
            
            $pdf        = PDF::loadview('AdmPelatihan.Cetak.cetak_depan',compact('peserta','direktur','kepala','kabupaten','cabang'))->setPaper($customPaper, 'portrait');
            return $pdf->download('cetak-laporan-ijazah-depan-peserta-pdf','I');
        }
    }

    public function cetak_depan_santri(Request $request)
    {
        $id         = $request->pelatihan_id;
        $pelatihan  = Pelatihan::find($id);
        $cabang     = $pelatihan->cabang->kabupaten->nama;
        $kabupaten  = substr($cabang, 5);
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
        if ($cabang == 'KOTA SURABAYA') {
            # code...
            $direktur   = "Dr. KH. Umar Jaeni M.Pd";
            $jabatan    = "Direktur Eksekutif";
            $kepala     = $jabatan;
            $pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_depan_santri',compact('peserta','direktur','kepala','cabang'))->setPaper($customPaper, 'portrait');
            return $pdf->download('cetak-laporan-ijazah-depan-peserta-santri-pdf','I');

        }else{
            $jabatan    = "Kacab. ".strtolower($kabupaten);
            $kepala     = ucwords($jabatan);
            $direktur   = $pelatihan->cabang->kepala->name;
            $pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_depan_santri',compact('peserta','direktur','kepala','cabang'))->setPaper($customPaper, 'portrait');
            return $pdf->download('cetak-laporan-ijazah-depan-peserta-pdf','I');
        }
    }

    public function cetak_belakang_santri(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
        // $customPaper = array(0,0,842.4,597.6);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_santri',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-santri-pdf');
    }

    public function cetak_belakang_munaqisy(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
        // $customPaper = array(0,0,842.4,597.6);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_munaqisy',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-munaqisy-pdf');
    }

    public function cetak_belakang_tahfidz(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
        // $customPaper = array(0,0,842.4,597.6);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_tahfidz',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-tahfidz-pdf');
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

    public function cetak_belakang_tot(Request $request)
    {
        $id = $request->pelatihan_id;
        $peserta = Peserta::where('pelatihan_id', $id)
                          ->where('bersyahadah', 1)->get();
        $customPaper = array(0,0,792,612);
    	$pdf = PDF::loadview('AdmPelatihan.Cetak.cetak_belakang_tot',compact('peserta'))->setPaper($customPaper, 'portrait');
    	return $pdf->download('cetak-laporan-ijazah-belakang-tot-pdf');
    }
}
