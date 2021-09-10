<?php

namespace App\Imports;
use App\Models\Negara;
use App\Models\Phonegara;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PhoneCodeLogatIndoImport implements ToCollection, WithStartRow
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
            
                $dt_code                = new Phonegara;
                $dt_code->country_name  = $row[1];
                $dt_code->phonecode     = $row[2];
                $dt_code->save();
        }
    }
}
