<?php

namespace App\Exports;

use App\Models\Peserta;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

// class PesertaAcaraExport implements FromCollection
class PesertaAcaraExport implements FromView
{
    public function __construct($acara_id)
    {
        $this->id=$acara_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    

    public function view(): View
    {
        return view('tilawatipusat.acara.peserta_export',[
            'peserta' => Peserta::with('kecamatan','kabupaten','provinsi','donatur')->get()
        ]);
    }

    
}
