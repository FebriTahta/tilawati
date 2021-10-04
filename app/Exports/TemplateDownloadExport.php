<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

// class TemplateDownloadExport implements FromCollection
class TemplateDownloadExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    public function __construct($jenis)
    {
        $this->jenis=$jenis;
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
        if ($this->jenis == 'guru') {
            # code...
            return view('tilawatipusat.template.guru');
        } elseif ($this->jenis == 'santri') {
            # code...
            return view('tilawatipusat.template.santri');
        } else{
            # code...
            return view('tilawatipusat.template.tot');
        }
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
