<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Lembaga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class LembagaDataExport implements FromView,ShouldAutoSize
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
        $lembaga = Lembaga::where('cabang_id', $this->cabang_id)->get();
        return view('tilawatipusat.cetak.cabang.data-lembaga-cabang',compact('lembaga'));
    }
}
