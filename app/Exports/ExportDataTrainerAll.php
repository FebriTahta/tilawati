<?php

namespace App\Exports;
use App\Models\Macamtrainer;
use App\Models\Trainer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDataTrainerAll implements ShouldAutoSize,FromView,WithColumnFormatting
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
        $trainer = Trainer::all();
        return view('tilawatipusat.cetak.cabang.data_trainer_all',compact('macam','trainer'));
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
