<?php

namespace App\Http\Controllers;
use Excel;
use App\Models\Acara;
use App\Models\Flyer;
use App\Models\Peserta;
use Log;
Use Image;
use App\Exports\TemplateDownloadExport;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TemplateDownloadCont extends Controller
{
    public function download_template(Request $request){
        if (request()->ajax()) {
            $jenis  = $request->jenis;
            return Excel::download(new TemplateDownloadExport($jenis),'template-'.$jenis.'.xlsx');
        }else{
            $jenis  = $request->jenis;
            return Excel::download(new TemplateDownloadExport($jenis),'template-'.$jenis.'.xlsx');
        }
    }
}
