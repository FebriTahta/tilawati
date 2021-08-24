<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

// class TemplateDownloadExport implements FromCollection
class TemplateDownloadExport implements FromView
{
    public function __construct($jenis)
    {
        $this->jenis=$jenis;
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
        } elseif ($this->jenis == 'santri') {
            # code...
            return view('tilawatipusat.template.santri');
        } else{
            # code...
            return view('tilawatipusat.template.tot');
        }
    }
}
