<?php

namespace App\Exports;
use App\Models\Cabang;
use App\Models\Program;
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
        foreach ($data as $key => $item) {
            # code...
            $dataz = [];
                        foreach ($item->pelatihan as $key => $value) {
                            # code...
                            $datax  = Program::where('id',$value->program_id)->first();                        
                            $dataz[$key] = $datax->id;
                        }
                        $programs = Program::whereIn('id',$dataz)->distinct()->get();
        }
        return view('tilawatipusat.cetak.cabang.laporan_data_cabang',compact('data','programs'));
    }
}
