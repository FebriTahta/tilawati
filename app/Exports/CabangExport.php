<?php

namespace App\Exports;
use App\Models\Cabang;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

// class CabangExport implements FromCollection
class CabangExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        $data = Cabang::with(['kabupaten','trainer','kpa','lembaga'])->get();
        return view('tilawatipusat.cetak.cabang.index');
    }
}
