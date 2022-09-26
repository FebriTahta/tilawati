<?php

namespace App\Exports;
use App\Models\Cabang;
use App\Models\Pelatihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanDataPerkembangan implements FromView, ShouldAutoSize
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
        $data = Cabang::withCount('pelatihan')->orderBy('pelatihan_count','desc')->with(['pelatihan' => function ($query) {
            $query->where('jenis','diklat');
        }])->get();
        
        return view('tilawatipusat.cetak.laporan_perkembangan',compact('data'));
    }
}
