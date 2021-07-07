<?php

namespace App\Imports;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Kabupaten;
use App\Models\Pelatihan;
use App\Models\Nilai;
use App\Models\Lembaga;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PesertaDiklatImport implements ToCollection
{

    public function __construct($id,$tanggal,$cabang_id)
    {
        $this->id=$id;
        $this->tanggal=$tanggal;
        $this->cabang_id=$cabang_id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 1) {
                $dt_pel = new Peserta;
                    $dt_pel->pelatihan_id = $this->id;
                    $dt_pel->cabang_id = $this->cabang_id;
                    $dt_pel->tanggal = $this->tanggal;
                    $dt_pel->name = $row[0];
                    $dt_pel->alamat = $row[1];
                    $dt_pel->kota = $row[2];
                    //inisialisasi kota / kabupaten yang diinput
                    $kab     = strtoupper($row[2]);
                    $kab_kab = 'KAB. '.$kab;
                    $kab_kot = 'KOTA '.$kab;
                    $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                    $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                    //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                    if ($tes_kab !== null) {
                        # code...
                        $kabupaten_id = $tes_kab->id;
                        $dt_pel->kabupaten_id = $kabupaten_id;
                        $dt_pel->provinsi_id = $tes_kab->provinsi->id;
                    } 
                    if ($tes_kot !== null) {
                        # code...
                        $kabupaten_id = $tes_kot->id;
                        $dt_pel->kabupaten_id = $kabupaten_id;
                        $dt_pel->provinsi_id = $tes_kot->provinsi->id;
                    }


                    $dt_pel->telp =$row[3];
                    $dt_pel->tmptlahir = $row[4];
                    
                    $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                    $dt_pel->tgllahir = $masuk;
                    
                    $lembaga = Lembaga::where('name',$row[6])->first();
                    if ($lembaga !== null) {
                        # code...
                        $dt_pel->lembaga_id=$lembaga->id;
                    }

                    $dt_pel->jilid =$row[7];
                    $dt_pel->kriteria=$row[8];

                    $kriteria = Kriteria::where('name',$row[8])->first();
                    if ($kriteria !== null) {
                        # code...
                        $dt_pel->kriteria_id = $kriteria->id;
                    }
                    $dt_pel->bersyahadah = $row[9];

                    $dt_pel->created_at = new \DateTime;
                    $dt_pel->save();

                    foreach ( $dt_pel->pelatihan->program->penilaian as $key => $value) {
                        # code...
                        $dt_n = new Nilai;
                        $dt_n->peserta_id = $dt_pel->id;
                        $dt_n->penilaian_id=$value->id;
                        $dt_n->nominal=$row[10+$key];
                        $dt_n->kategori=$value->kategori;
                        $dt_n->save();
                    }
                    
                    $id = $dt_pel->id;
                    \QrCode::size(150)
                    ->format('png')
                    ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$dt_pel->id.'/'.$dt_pel->pelatihan->program->id.'/'.$dt_pel->pelatihan->id, public_path('images/'.$id.'qrcode.png'));
            }   
        }
    }
}
