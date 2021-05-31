<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use DB;
use App\Models\Peserta;

class PesertaToTImport implements ToCollection, WithChunkReading, ShouldQueue
{
    public function __construct($id,$tanggal)
    {
        $this->id=$id;
        $this->tanggal=$tanggal;
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
                $dt_pel->tanggal = $this->tanggal;
                $dt_pel->name = $row[0];
                $dt_pel->alamat = $row[1];
                $dt_pel->kota = $row[2];
                $dt_pel->telp =$row[3];
                $dt_pel->tmptlahir = $row[4];
                $dt_pel->tgllahir =$row[5];
                $dt_pel->fs = $row[6];
                $dt_pel->tj =$row[7];
                $dt_pel->gm =$row[8];
                $dt_pel->sl = $row[9];
                $dt_pel->im =$row[10];
                $dt_pel->il =$row[11];
                $dt_pel->i =$row[12];
                $dt_pel->kriteria = $row[13];
                $dt_pel->jilid = $row[14];
                $dt_pel->bersyahadah = $row[15];
                $dt_pel->lembaga = $row[16];
                $dt_pel->munaqisy =  $row[17];
                $dt_pel->created_at = new \DateTime;
                $dt_pel->save();
                $id = $dt_pel->id;
                \QrCode::size(150)
                ->format('png')
                ->generate(request()->url('http://course-academy.top/diklat/'.$id.'/'), public_path('images/'.$id.'qrcode.png'));

            }   
        }
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
