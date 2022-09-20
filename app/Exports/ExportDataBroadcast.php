<?php

namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDataBroadcast implements FromQuery, WithHeadings, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    use Exportable;

    public function __construct($from,$till)
    {
        $this->from=$from;
        $this->till=$till;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function query(){
        
        if ($this->from == '' && $this->till =='') {
            return Peserta::select('name','telp','kabupaten_id');
        }else {
            return Peserta::with('kabupaten')->whereBetween('tanggal', array($this->from, $this->till));
        }
    }

    public function map($row): array{
    
        if($row->kabupaten !== null)
        {
            $kota = $row->kabupaten->nama;
            
        }else {
            $kota = '';
        }

        return [
            $row->name,
            $row->telp,
            $kota
        ];
    }

    public function headings(): array{
        return [
            "NAMA TARGET",
            "TELP TARGET",
            "ASAL KOTA"
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }
    
}
