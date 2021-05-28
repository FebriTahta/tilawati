<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\PesertaImport;
use App\Imports\PesertaGuruImport;
use App\Imports\PesertaToTImport;
use App\Imports\PesertaTahfidzImport;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    public function importPeserta(Request $request)
    {
        $id = $request->id ;
        $tanggal = $request->tanggal;
        Excel::import(new PesertaImport($id, $tanggal), $request->file('file'));
        return redirect()->back()->with('success','Peserta Berhasil Ditambahkan Melalui file Excel');
    }

    public function importPesertaGuru(Request $request)
    {
        $id = $request->id;
        Excel::queueImport(new PesertaGuruImport($id), $request->file('file'));
        return redirect()->back()->with('success','Peserta Berhasil Ditambahkan Melalui file Excel');
    }

    public function importPesertaToT(Request $request)
    {
        $id = $request->id;
        Excel::queueImport(new PesertaToTImport($id), $request->file('file'));
        return redirect()->back()->with('success','Peserta Berhasil Ditambahkan Melalui file Excel');
    }

    public function importPesertaTahfidz(Request $request)
    {
        $id = $request->id;
        Excel::queueImport(new PesertaTahfidzImport($id), $request->file('file'));
        return redirect()->back()->with('success','Peserta Berhasil Ditambahkan Melalui file Excel');
    }
}
