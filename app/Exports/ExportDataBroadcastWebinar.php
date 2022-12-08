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
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDataBroadcastWebinar implements FromQuery, WithHeadings, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function query(){
        // return Peserta::whereHas('pelatihan')->with('kabupaten','program')->with('pelatihan', function($q) {
        //     $q->where('jenis','webinar');
        // })
        // ->select('name','telp','kabupaten_id','program_id')
        // ->get();

        // $peserta = Peserta::with('program', function($q){
        //     $q->where('status','2');
        // })->with('kabupaten')->select('name','telp','kabupaten_id','program_id');
        // return $peserta;

        return Peserta::whereHas('program', function($q){
            $q->where('status','2');
        });
    }


    public function map($row): array{
    
        // if($row->kabupaten !== null)
        // {
        //     $kota = $row->kabupaten->nama;
            
        // }else {
        //     $kota = '';
        // }

        // if ($row->program !== null) {
        //     # code...
        //     $program = $row->program->name;
        // }else {
        //     # code...
        //     $program = '';
        // }

        // return [
        //     $row->name,
        //     $row->program->name,
        //     $row->tanggal,
        //     $row->telp,
        //     $kota
        // ];
        return [
            $row->name,
            $row->program->name,
            \Carbon\Carbon::parse($row->tanggal)->format('d F Y'),
            $row->telp,
            $row->kota
        ];
    }

    public function headings(): array{
        // return [
        //     "NAMA ",
        //     "PELATIHAN",
        //     "TANGGAL PELATIHAN",
        //     "TELP ",
        //     "ASAL KOTA"
        // ];

        return [
            'NAMA',
            'PELATIHAN',
            'TANGGAL PELATIHAN',
            'TELP',
            'ASAL KOTA',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
