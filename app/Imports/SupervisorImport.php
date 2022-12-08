<?php

namespace App\Imports;
use App\Models\Supervisor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SupervisorImport implements ToCollection
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }

    public function collection(Collection $collection)
    {
        // $munaqisy = Supervisor::where('cabang_id', $this->cabang_id)->get();

        // if ($munaqisy->count() > 0) {
        //     # code...
        //     $munaqisy->delete();
        // }

        foreach ($collection as $key => $row) {
                $data= Supervisor::where('name',$row[1])->where('cabang_id', $this->cabang_id)->first();
                if ($key >= 6) {
                    if ($data == null) {
                        # code...
                        $muna = new Supervisor;
                        $muna->cabang_id = $this->cabang_id;
                        $muna->name = $row[1];
                        $muna->telp = $row[2];
                        $muna->alamat = $row[3];
                        $muna->created_at = new \DateTime;
                        $muna->save();
                        
                        
                    }else {
                        # code...
                        if ($row[1] !== null && $row[1] !== ' ') {
                            # code...
                            $super = Supervisor::updateOrCreate(
                                [
                                    'id' => $data->id,
                                ],
                                [
                                    'cabang_id' => $this->cabang_id,
                                    'name' => $row[1],
                                    'telp' => $row[2],
                                    'alamat' => $row[3],
                                ]
                            );
                        }
                        
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
