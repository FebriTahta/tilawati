<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Cabang;
use App\Models\Pelatihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ExportLaporanDataCabangPeriode implements FromView, ShouldAutoSize
{
    public function __construct($dari,$sampai)
    {
        $this->dari=$dari;
        $this->sampai=$sampai;
    }

    public function view(): View
    {
        $dari = $this->dari;
        $sampai = $this->sampai;

        $data = Cabang::has('pelatihan')->with(['pelatihan' => function ($query) use ($dari, $sampai) {
            $query->where('jenis','diklat')->whereBetween('tanggal', array($dari, $sampai));
        }])->get();
        
        
        return view('tilawatipusat.cetak.cabang.laporan_data_cabang_periode',compact('data','dari','sampai'));
    }
}
