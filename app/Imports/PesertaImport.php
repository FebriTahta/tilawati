<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Peserta;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Http\Request;
class PesertaImport implements ToCollection
{
    public function __construct($id,$tanggal)
    {
        $this->id=$id;
        $this->tanggal=$tanggal;
        
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 1) {
                
                // $dt_peserta = [
                //     'pelatihan_id' => $this->id,
                //     'name' => $row[0],
                //     'alamat' => $row[1],
                //     'kota' => $row[2],
                //     'telp' => $row[3],
                //     'tmptlahir' => $row[4],
                //     'tgllahir' => $row[5],
                //     'fs' => $row[6],
                //     'tj' => $row[7],
                //     'gm' => $row[8],
                //     'sl' => $row[9],
                //     'jilid' => $row[10],
                //     'bersyahadah' => $row[11],
                //     'kriteria' => $row[12],
                //     'created_at' => new \DateTime,
                // ];
                // DB::table('pesertas')->insert($dt_peserta);

                    $dt_pel = new Peserta;
                    $dt_pel->pelatihan_id = $this->id;
                    $dt_pel->tanggal = $this->tanggal;
                    $dt_pel->name = $row[0];
                    $dt_pel->alamat = $row[1];
                    $dt_pel->kota = $row[2];
                    $dt_pel->telp =$row[3];
                    $dt_pel->tmptlahir = $row[4];
                    $dt_pel->tgllahir =$row[5];
                    $dt_pel->fs = $row[6];
                    $dt_pel->tj =$row[7];
                    $dt_pel->gm =$row[8];
                    $dt_pel->sl = $row[9];
                    $dt_pel->jilid =$row[10];
                    $dt_pel->bersyahadah = $row[11];
                    $dt_pel->kriteria = $row[12];
                    $dt_pel->created_at = new \DateTime;
                    $dt_pel->save();
                    $id = $dt_pel->id;
                    $link = 'http://course-academy.top/diklat/'.$id.'/';
                    \QrCode::size(150)
                    ->format('png')
                    ->generate(request()->url($link), public_path('images/'.$id.'qrcode.png'));
            }   
        }
    }
}
