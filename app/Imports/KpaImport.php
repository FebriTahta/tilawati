<?php

namespace App\Imports;
use App\Models\Kpa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KpaImport implements ToCollection
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 6) {
                $data= Kpa::where('name',$row[1])->where('cabang_id', $this->cabang_id)->first();
    
                if ($data == null) {
                    # code...
                    $trainer = new Kpa;
                    $trainer->cabang_id = $this->cabang_id;
                    $trainer->name = $row[1];
                    $trainer->ketua = $row[2];
                    $trainer->wilayah = $row[3];
                    $trainer->telp = $row[4];
                    $trainer->created_at = new \DateTime;
                    $trainer->save();
                    
                }else {
                    # code...
                    $trainer = Kpa::updateOrCreate(
                        [
                            'id' => $data->id
                        ],
                        [
                            'ketua'        => $row[2],
                            'wilayah'      => $row[3],
                            'telp'         => $row[4],
                        ]
                    );
                }
            }
        }
    }
}
