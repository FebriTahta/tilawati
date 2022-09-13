<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Munaqisy;
use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDataMunaqisy implements FromView,ShouldAutoSize,WithColumnFormatting
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }

    public function view(): View
    {
        $cabang = Cabang::where('id', $this->cabang_id)->first();
        $munaqisy = Munaqisy::where('cabang_id', $this->cabang_id)->get();
        return view('tilawatipusat.cetak.munaqisy.data_munaqisy',compact('munaqisy','cabang'));
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
