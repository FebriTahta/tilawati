<?php

namespace App\Exports;
use App\Models\Peserta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

// class SeluruhPesertaExport implements FromCollection
class SeluruhPesertaExport implements FromView
{

    public function __construct($from,$till)
    {
        $this->from=$from;
        $this->till=$till;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        if ($this->from == '' && $this->till =='') {
            # code...
            return view('tilawatipusat.cetak.peserta.index',[
                'peserta' => Peserta::with('kabupaten')->get()
            ]);
        }elseif($this->from != '' && $this->till !=''){
            $peserta = Peserta::whereBetween('tanggal', array($this->from, $this->till))->with('kabupaten')->get();
            return view('tilawatipusat.cetak.peserta.index',compact('peserta'));
        }
    }
}
