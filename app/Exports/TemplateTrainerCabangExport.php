<?php

namespace App\Exports;
use App\Models\Macamtrainer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class TemplateTrainerCabangExport implements ShouldAutoSize,FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        $macam = Macamtrainer::all();
        return view('tilawatipusat.cetak.cabang.template_import_trainer',compact('macam'));
    }
}
