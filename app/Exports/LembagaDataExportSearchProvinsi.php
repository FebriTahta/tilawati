<?php

namespace App\Exports;
use App\Models\Lembaga;
use App\Models\Provinsi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LembagaDataExportSearchProvinsi implements FromView, ShouldAutoSize, WithColumnFormatting
{
    public function __construct($provinsi_id)
    {
        $this->provinsi_id=$provinsi_id;
    }

    public function view(): View
    {
        $provinsi   = Provinsi::find($this->provinsi_id);
        $data       = Lembaga::where('provinsi_id',$this->provinsi_id)->get();
        return view('tilawatipusat.cetak.lembaga.lembaga_data_search_provinsi',compact('data','provinsi'));
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
