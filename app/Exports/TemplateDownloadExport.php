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
        if ($this->jenis == "standarisasi guru al qur'an level 1" ) {
            # code...
            return view('tilawatipusat.template.lvl1');
        } elseif ($this->jenis == "standarisasi guru al qur'an level 2") {
            # code...
            return view('tilawatipusat.template.lvl2');
        } elseif ($this->jenis == "munaqosyah santri") {
            # code...
            return view('tilawatipusat.template.muna_santri');
        } elseif ($this->jenis == "diklat guru tahfidz") {
            # code...
            return view('tilawatipusat.template.guru_tahfidz');
        } elseif($this->jenis == "diklat munaqisy lembaga") {
            #code...
            return view('tilawatipusat.template.lvl1');
        }else {
            # code...
            return view('tilawatipusat.template.lvl1');
        }
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => NumberFormat::FORMAT_TEXT,
    //         'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }
}
