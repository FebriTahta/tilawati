<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Supervisor;
use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDataSupervisor implements FromView,ShouldAutoSize,WithColumnFormatting
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }

    public function view(): View
    {
        $cabang = Cabang::where('id', $this->cabang_id)->first();
        $supervisor = Supervisor::where('cabang_id', $this->cabang_id)->get();
        return view('tilawatipusat.cetak.supervisor.data_supervisor',compact('supervisor','cabang'));
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
