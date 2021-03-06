<?php

namespace App\Imports;
use App\Models\Peserta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PesertaTahfidzImport implements ToCollection, WithChunkReading, ShouldQueue
{
    public function __construct($id, $tanggal)
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
                $dt_pel->tf = $row[6];
                $dt_pel->tj =$row[7];
                $dt_pel->fs =$row[8];
                $dt_pel->mt = $row[9];
                $dt_pel->kriteria = $row[10];
                $dt_pel->jilid = $row[11];
                $dt_pel->bersyahadah = $row[12];
                $dt_pel->lembaga = $row[13];
                $dt_pel->created_at = new \DateTime;
                $dt_pel->save();
                $id = $dt_pel->id;
                $link = 'http://course-academy.top/diklat/'.$id.'/';
                \QrCode::size(150)
                ->format('png')
                ->generate(request()->url($link), public_path('images/'.$id.'qrcode.png'));
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
