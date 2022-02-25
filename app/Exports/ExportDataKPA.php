<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Kpa;
use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDataKPA implements FromView, ShouldAutoSize
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
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
        $kpa = Kpa::where('cabang_id', $this->cabang_id)->get();
        $cabang = Cabang::find($this->cabang_id);
        return view('tilawatipusat.cetak.cabang.data-kpa-cabang',compact('kpa','cabang'));
    }
}
