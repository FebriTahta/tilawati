<?php

namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PesertaPendaftaranExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $peserta    = Peserta::where('pelatihan_id', $this->pelatihan_id)->with('pelatihan','kabupaten')->get();
        (string)$peserta;
        return view('tilawatipusat.cetak.peserta.peserta_pendaftaran',compact('peserta'));
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
