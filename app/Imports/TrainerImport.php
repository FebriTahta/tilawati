<?php

namespace App\Imports;
use App\Models\Trainer;
use App\Models\Macamtrainer;
use App\Models\macamtrainer_trainer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TrainerImport implements ToCollection
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
                $data= Trainer::where('name',$row[1])->where('cabang_id', $this->cabang_id)->first();
                $template_nama = substr($row[1],0,4);

                if ($template_nama !== 'Nama') {
                    if ($data == null) {
                        # code...
                        $trainer = new Trainer;
                        $trainer->cabang_id = $this->cabang_id;
                        $trainer->name = $row[1];
                        $trainer->telp = $row[2];
                        $trainer->alamat = $row[3];
                        $trainer->created_at = new \DateTime;
                        $trainer->save();
                        
                        $macam = Macamtrainer::all();
                        $total = $macam->count();
                        $i = 4;
                        foreach ($macam as $key => $value) {
                            # code...
                            
                            if ($row[$i] !== null) {
                                # code...
                                $ok_trainer = new macamtrainer_trainer;
                                $ok_trainer->created_at = new \DateTime;
                                $ok_trainer->macamtrainer_id = $value->id;
                                $ok_trainer->trainer_id = $trainer->id;
                                $ok_trainer->save();
                            }
                            $i++;
                        }
                    }else {
                        # code...
                        $trainer = Trainer::updateOrCreate(
                            [
                                'id' => $data->id
                            ],
                            [
                                'telp'        => $row[2],
                                'alamat'      => $row[3],
                            ]
                        );
    
                        $macam2 = macamtrainer_trainer::where('trainer_id', $data->id)->delete();
                        $macam = Macamtrainer::all();
                        $total = $macam->count();
                        $i = 4;
                        foreach ($macam as $key => $value) {
                            # code...
                            if ($row[$i] !== null) {
                                # code...
                                $ok_trainer = new macamtrainer_trainer;
                                $ok_trainer->created_at = new \DateTime;
                                $ok_trainer->macamtrainer_id = $value->id;
                                $ok_trainer->trainer_id = $trainer->id;
                                $ok_trainer->save();
                            }
                            $i++;
                        }
                    }
                }
            }
        }
    }
}
