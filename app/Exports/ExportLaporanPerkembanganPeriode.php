<?php

namespace App\Exports;
use App\Models\Cabang;
use App\Models\Pelatihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanPerkembanganPeriode implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function __construct($dari,$sampai)
    {
        $this->dari=$dari;
        $this->sampai=$sampai;
    }

    public function view(): View
    {
        $dari = $this->dari;
        $sampai = $this->sampai;
        $data = Cabang::withCount('pelatihan')->orderBy('pelatihan_count','desc')->with(['pelatihan' => function ($query) use ($dari,$sampai) {
            $query->where('jenis','diklat')->whereBetween('tanggal', array($dari, $sampai));
        }])->get();
        
        return view('tilawatipusat.cetak.laporan_perkembangan_periode',compact('data','dari','sampai'));
    }
}
