<?php

namespace App\Imports;
use App\Models\Cabang;
use App\Models\Apicabangtilawati;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Kepala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ApicabangtilawatiImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 2) {
                # code...

                $dt_cab             = new Apicabangtilawati;
                $dt_cab->name       = $row[0];
                $dt_cab->status     = $row[1];
                $dt_cab->alamat     = $row[7];
                
                $kode = mt_rand(100000, 999999);
                
                $cek_kode_cabang    = Apicabangtilawati::where('kode', $kode)->first();
                if ($cek_kode_cabang == null) {
                    # code...
                    $dt_cab->kode       = $kode;
                } else {
                    # code...
                    $kode  = mt_rand(100000, 999999);
                    $hasil = $kode + $key;
                    $dt_cab->kode       = $hasil;
                }

                //inisialisasi kota / kabupaten yang diinput
                $kab     = strtoupper($row[3]);
                $kab_kab = 'KAB. '.$kab;
                $kab_kot = 'KOTA '.$kab;
                $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                if ($tes_kab !== null) {
                    # code...
                    $kabupaten_id = $tes_kab->id;
                    $dt_cab->kabupaten_id = $kabupaten_id;
                    $dt_cab->provinsi_id = $tes_kab->provinsi->id;
                } 
                if ($tes_kot !== null) {
                    # code...
                    $kabupaten_id = $tes_kot->id;
                    $dt_cab->kabupaten_id = $kabupaten_id;
                    $dt_cab->provinsi_id = $tes_kot->provinsi->id;
                }
                //lanjut protses insert data
                $dt_cab->kepalacabang = $row[4];
                $dt_cab->kadivre    = $row[5];
                $dt_cab->teritorial = $row[6];
                $dt_cab->telp       = $row[8];
                $dt_cab->created_at = new \DateTime;
                $dt_cab->save();
            }   
        }
    }

    
}
