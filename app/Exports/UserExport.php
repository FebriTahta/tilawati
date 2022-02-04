<?php

namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class UserExport implements FromCollection
class UserExport implements FromQuery, WithHeadings, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    use Exportable;

    public function query(){
        return Cabang::query()->with(['user','kabupaten'])
            ->select('id','name','kabupaten_id','user_id','kabupaten_id');
    }

    public function map($row): array{
        
        return [
            $row->kabupaten->nama,
            $row->user->username,
            $row->user->pass,
            $row->name,
        ];
    }

    public function headings(): array{
        return [
            "KOTA",
            "USERNAME",
            "PASSWORD",
            "NAME",
        ];
    }
    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => NumberFormat::FORMAT_TEXT,
    //     ];
    // }
}
