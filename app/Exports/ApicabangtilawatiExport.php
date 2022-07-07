<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Apicabangtilawati;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApicabangtilawatiExport implements FromQuery, WithHeadings, ShouldAutoSize,  WithColumnFormatting, WithMapping
{
    use Exportable;

    public function query(){
        return Apicabangtilawati::query()
            ->select('name','status','provinsi_id','kabupaten_id','kepalacabang','kadivre','teritorial','alamat','telp','created_at')
            ->orderBy('created_at','ASC');
    }

    public function map($row): array{
        
        if ($row->provinsi !== null) {
            # code...
            $prov = $row->provinsi->nama;
        } else {
            # code...
            $prov = '-';
        }

        if ($row->kabupaten !== null) {
            # code...
            $kab = substr($row->kabupaten->nama,5);
        } else {
            # code...
            $kab = '-';
        }

        return [
            // $row->kode,
            strtoupper($row->name),
            strtoupper($row->status),
            $prov,
            $kab,
            $row->kepalacabang,
            strtoupper($row->kadivre),
            strtoupper($row->teritorial),
            strtoupper($row->alamat),
            $row->telp,
        ];
    }

    public function headings(): array{
        return [
            // "KODE",
            "NAMA CABANG",
            "STATUS",
            "PROVINSI",
            "KABUPATEN / KOTA",
            "KEPALA CABANG",
            "KADIVRE",
            "TERITORIAL",
            "ALAMAT",
            "TELP"
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_TEXT,            
        ];
    }
}
