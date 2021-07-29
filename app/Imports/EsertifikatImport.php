<?php

namespace App\Imports;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Kabupaten;
use App\Models\Pelatihan;
use App\Models\Nilai;
use App\Models\Lembaga;
use App\Models\Certificate;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EsertifikatImport implements ToCollection, WithChunkReading, ShouldQueue
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
                    $dt_pel->name = $row[1];
                    $dt_pel->status = 3;
                    $dt_pel->created_at = new \DateTime;
                    $dt_pel->save();

                    $dt_n = new Certificate;
                    $dt_n->peserta_id = $dt_pel->id;
                    $dt_n->no = $row[0];
                    $dt_n->link = $row[2];
                    $dt_n->created_at = new \DateTime;
                    $dt_n->save();
            }   
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
