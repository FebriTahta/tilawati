<?php

namespace App\Exports;
use App\Models\Cabang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

// class CabangExport implements FromCollection
class CabangExport implements FromView,ShouldAutoSize
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
        $data = Cabang::where('status','cabang')->with(['kabupaten','trainer','kpa','lembaga'])->get();
        $data2 = Cabang::where('status','rpq')->with(['kabupaten','trainer','kpa','lembaga'])->get();
        return view('tilawatipusat.cetak.cabang.index',compact('data','data2'));
    }
}
