<?php

namespace App\Http\Controllers;
use App\Exports\SeluruhPesertaExport;
use Excel;
use Redirect;
use Illuminate\Http\Request;

class ExportCont extends Controller
{
    public function export_seluruh_peserta(Request $request)
    {
        $from = $request->from;
        $till = $request->till;
        if ($from != '' && $till == '' || $from == '' && $till != '') {
            # code...
            return Redirect::back()->withFail('Pastikan kedua parameter pencarian diisi jika ingin mensortir');
        }else{
            return Excel::download(new SeluruhPesertaExport($from,$till),'peserta-dari_'.$from.'_sampai_'.$till.'.xlsx');
        }
        
    }
}
