<?php

namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\FromView;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
// Use PhpOffice\PhpSpreadsheet\Shared\Date;
// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;


// class PesertaPendaftaranExport implements FromView, ShouldAutoSize, WithColumnFormatting
class PesertaPendaftaranExport implements FromQuery, WithHeadings, Date, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    use Exportable;

    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }

    public function query(){
        // return Peserta::where('pelatihan_id', $this->pelatihan_id)->get();
        return Peserta::query()
            ->select('tgllahir');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function view(): View
    // {
    //     $peserta    = Peserta::where('pelatihan_id', $this->pelatihan_id)->with('pelatihan','kabupaten')->get();
    //     (string)$peserta;
    //     return view('tilawatipusat.cetak.peserta.peserta_pendaftaran',compact('peserta'));
    // }

    public function map($row): array{
        return [
            Date::dateTimeToExcel($row->tgllahir),
        ];
    }

    public function headings(): array{
        return [
            "tanggal lahir"
        ];
    }
    public function columnFormats(): array
    {
        // return [
        //     'E' => NumberFormat::FORMAT_TEXT,
        //     'G' => NumberFormat::FORMAT_DATE_DDMMYYYY
        // ];
        return [
            // 'E' => NumberFormat::FORMAT_TEXT,
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
