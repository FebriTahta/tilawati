<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Trainer;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDataTrainer implements FromView,ShouldAutoSize
{
    public function __construct($cabang_id,$macam)
    {
        $this->cabang_id=$cabang_id;
        $this->macam = $macam;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        $macam = $this->macam;
        $trainer = Trainer::where('cabang_id', $this->cabang_id)->get();
        return view('tilawatipusat.cetak.cabang.data-instruktur-cabang',compact('trainer','macam'));
    }
}
