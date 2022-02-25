<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class PesertaDiklatExport2 implements FromCollection,ShouldAutoSize
{

    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        $data = Pelatihan::where('id', $this->pelatihan_id)->first();
        return view('tilawatipusat.cetak.peserta.peserta_diklat',compact('data'));
    }
}
