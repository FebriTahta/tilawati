<?php

namespace App\Imports;
use App\Models\Munaqisy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MunaqisyImport implements ToCollection
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }
    
    public function collection(Collection $collection)
    {
        $munaqisy = Munaqisy::where('cabang_id', $this->cabang_id)->get();

        if ($munaqisy->count() > 0) {
            # code...
            $munaqisy->delete();
        }

        foreach ($collection as $key => $row) {
                $data= Munaqisy::where('name',$row[1])->where('cabang_id', $this->cabang_id)->first();
                if ($key >= 6) {
                    if ($data == null) {
                        # code...
                        $muna = new Munaqisy;
                        $muna->cabang_id = $this->cabang_id;
                        $muna->name = $row[1];
                        $muna->telp = $row[2];
                        $muna->alamat = $row[3];
                        $muna->created_at = new \DateTime;
                        $muna->save();
                        
                        
                    }
                }
                
        }

        
    }

    public function batchSize(): int
        {
            return 10;
        }

        public function chunkSize(): int
        {
            return 10;
        }
}
