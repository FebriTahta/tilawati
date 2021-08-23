<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Acara;
use App\Models\Flyer;
use App\Models\Peserta;
Use Image;
use App\Exports\TemplateDownloadExport;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TemplateDownloadCont extends Controller
{
    public function download_template($jenis_template){
        return Excel::download(new TemplateDownloadExport($jenis_template),'template-'.$jenis_template.'.xlsx');
    }
}
