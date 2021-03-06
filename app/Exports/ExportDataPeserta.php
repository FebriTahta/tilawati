<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDataPeserta implements FromView,ShouldAutoSize
{
    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id = $pelatihan_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
        
    // }

    public function view(): View
    {
        $peserta = Peserta::where('pelatihan_id',$this->pelatihan_id)->get();
        $pelatihan = Pelatihan::where('id', $this->pelatihan_id)->first();
        return view('tilawatipusat.cetak.cabang.data-peserta-cabang',compact('peserta','pelatihan'));
    }
}
