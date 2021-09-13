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

class EsertifikatImport implements ToCollection
{
    public function __construct($id)
    {
        $this->id=$id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $data       = Induksertifikat::find($this->id);
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 1) {
                $sertifikat = Certificate::where('name',$row[1])->where('induksertifikat',$this->id)->first();
                if ($sertifikat == null) {
                    # code...
                    $dt_n = new Certificate;
                    $dt_n->induksertifikat_id = $this->id;
                    $dt_n->no           = $row[0];
                    $dt_n->name         = $row[1];
                    $dt_n->link         = $row[2];
                    $dt_n->created_at   = new \DateTime;
                    $dt_n->save();
                    
                }
            }   
        }
    }
}
