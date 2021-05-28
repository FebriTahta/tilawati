<?php

namespace App\Http\Controllers;
use App\Models\Kriteria;
use App\Models\Pelatihan;
use App\Models\Lembaga;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function daftarpeserta($id)
    {
        $dt_k = Kriteria::all();
        $dt_lem = Lembaga::all();
        $dt_pel = Pelatihan::find($id);
        $dt_ket = $dt_pel->keterangan;
        $keterangans = Kriteria::where('untuk', $dt_ket)->get();
        $dt_pes = Peserta::where('pelatihan_id', $id)->get();
        return view('AdmPelatihan.Pelatihan.peserta', compact('keterangans','dt_k','dt_pel','dt_lem','dt_pes'));
    }

    public function storepes(Request $request)
    {
        try {
            //code...
            $dt_pes = new Peserta;
            $dt_pes->pelatihan_id = $request->pelatihan_id;
            $dt_pes->lembaga = $request->lembaga;
            $dt_pes->name = $request->name;
            $dt_pes->tmptlahir = $request->tmptlahir;
            $dt_pes->tgllahir = $request->tgllahir2;
            $dt_pes->alamat = $request->alamat;
            $dt_pes->kota = $request->kota;
            $dt_pes->telp = $request->telp;
            $dt_pes->email = $request->email;
            $dt_pes->fs = $request->fs;
            $dt_pes->tj = $request->tj;
            $dt_pes->gm = $request->gm;
            $dt_pes->sl = $request->sl;
            $dt_pes->mt = $request->mt;
            $dt_pes->bersyahadah = $request->syahadah;
            $dt_pes->jilid = $request->jilid;
            $dt_pes->kriteria = $request->kriteria;
            $dt_pes->munaqisy = $request->munaqisy;
            $dt_pes->save();
            \QrCode::size(150)
            ->format('png')
            ->generate('www.nurulfalah.org', public_path('images/'.$dt_pes->id.'qrcode.png'));
            return redirect()->back()->with('success', 'Data Peserta Berhasil Ditambahkan');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
