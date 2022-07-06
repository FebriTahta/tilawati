<?php

namespace App\Exports;
use App\Models\Cabang;
use App\Models\Pelatihan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLaporanDataCabang implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $data = Cabang::has('pelatihan')->with(['pelatihan' => function ($query)  {
            $query->where('jenis','diklat');
        }])->get();
        $pelatihan_guru     = Pelatihan::where('cabang_id', $data->id)->where('keterangan', 'guru')->get();
        $pelatihan_santri   = Pelatihan::where('cabang_id', $data->id)->where('keterangan', 'santri')->get();
        return view('tilawatipusat.cetak.cabang.laporan_data_cabang',compact('data','pelatihan_guru','pelatihan_santri'));
    }
}
