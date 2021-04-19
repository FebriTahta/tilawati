<?php

namespace App\Imports;
use DB;
use App\Models\Peserta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class PesertaGuruImport implements ToCollection, WithChunkReading, ShouldQueue
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
                    'mt' => $row[10],
                    // 'kriteria' => $row[11],
                    // 'jilid' => $row[12],
                    // 'bersyahadah' => $row[13],
                    // 'lembaga' => $row[14],
                    'kriteria'=> $row[11],
                    'jilid' => $row[12],
                    'bersyahadah' => $row[13],
                    'lembaga'=> $row[14],
                    'munaqisy'=> $row[15],
                ];
                DB::table('pesertas')->insert($dt_peserta);
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
