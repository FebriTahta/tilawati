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
    // public function collection()
    // {
    //     return new Collection([
    //         ['nama','email']
    //     ]);
    //     // return Peserta::all();
    //     // dd (Peserta::with('donatur')->select('name','email','donatur_data')->get());
    //     // return DB::table('pesertas')->select('name')->get();

    //     // return $data = Peserta::select('name','email')->with('donatur',function($data){
            
    //     //     if ($data->donatur!==null) {
    //     //         # code...
    //     //         $x = $data->donatur->select('data','peserta_id');
                
    //     //     }
    //     // })->get();
    //     // return Peserta::with('donatur',function($a){
    //     //     $a->select('data','peserta_id');
    //     // })->get();
    //     // return Peserta::with('donatur:data')->get();
    // }

    public function view(): View
    {
        return view('tilawatipusat.acara.peserta_export',[
            'peserta' => Peserta::with('kecamatan','kabupaten','provinsi','donatur')->get()
        ]);
    }

    
}
