<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TemplateMunaqisyExport implements ShouldAutoSize,FromView,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('tilawatipusat.cetak.munaqisy.template');
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
