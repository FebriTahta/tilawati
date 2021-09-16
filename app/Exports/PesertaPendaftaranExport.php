<?php

namespace App\Exports;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class PesertaPendaftaranExport implements FromView
{
    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $peserta    = Peserta::where('pelatihan_id', $this->pelatihan_id)->with('pelatihan','kabupaten')->get();
        return view('tilawatipusat.cetak.peserta.peserta_pendaftaran',compact('peserta'));
    }
}
