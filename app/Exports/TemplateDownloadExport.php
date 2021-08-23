<?php

namespace App\Exports;
use App\Models\Peserta;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

// class TemplateDownloadExport implements FromCollection
class PesertaAcaraExport implements FromView
{
    public function __construct($jenis_template)
    {
        $this->jenis=$jenis_template;
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
        if ($this->jenis == 'guru') {
            # code...
            return view('tilawatipusat.template.guru');
        } else {
            # code...
            return view('tilawatipusat.template.santri');
        }
    }
}
