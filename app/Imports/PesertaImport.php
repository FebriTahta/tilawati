<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Peserta;
use DB;
class PesertaImport implements ToCollection
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
        
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 1) {
                
                $dt_peserta = [
                    'pelatihan_id' => $this->id,
                    'name' => $row[0],
                    'alamat' => $row[1],
                    'kota' => $row[2],
                    'telp' => $row[3],
                    'tmptlahir' => $row[4],
                    'tgllahir' => $row[5],
                    'fs' => $row[6],
                    'tj' => $row[7],
                    'gm' => $row[8],
                    'sl' => $row[9],
                    'jilid' => $row[10],
                    'bersyahadah' => $row[11],
                    'kriteria' => $row[12],
                    'created_at' => new \DateTime,
                ];
                DB::table('pesertas')->insert($dt_peserta);
            }   
        }
    }
}
