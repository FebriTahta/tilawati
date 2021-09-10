<?php

namespace App\Imports;
use App\Models\Negara;
use App\Models\Phonegara;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PhoneCodeImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            
            $negara = Negara::where('country_name', $row[1])->first();
            if ($negara != null) {
                # code...
                $dt_code                = new Phonegara;
                $dt_code->negara_id     = $negara->id;
                $dt_code->country_name  = $negara->country_name;
                $dt_code->phonecode     = $row[2];
                $dt_code->save();
            }
        }
    }
    
}
