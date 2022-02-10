<?php

namespace App\Exports;
use App\Models\Cabang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class CabangKpaExport implements FromCollection
class CabangKpaExport implements FromView,ShouldAutoSize
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
        return view('tilawatipusat.cetak.cabang.kpa',compact('data','data2'));
    }
}
