<?php

namespace App\Imports;
use App\Models\Cabang;
use App\Models\User;
use App\Models\Lembaga;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Kepala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Hash;
class LembagaImport implements ToCollection, WithChunkReading
{
    public function __construct($cabang_id)
    {
        $this->cabang_id=$cabang_id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 6) {
                // $cabang = Cabang::where('cabang_id',$cabang_id)->first();
                $data = Lembaga::where('cabang_id', $this->cabang_id)->where('name',$row[1])->first();
                $cabang = Cabang::where('id',$this->cabang_id)->first();
                $kode = mt_rand(100000, 999999);
                $hasil = 'lmb-'.$kode.'-cb-'.$cabang->id.'-'.$cabang->lembaga->count();

                $template_nama = substr($row[1],0,4);
                        
                // if ($data !== null) {
                //     # code...
                //     if (substr($data->name,0,4) == $template_nama) {
                //         # code...
                //         $data->delete();
                //     }
                // }


                if ($template_nama !== 'Nama') {
                    # code...
                    if ($data == null) {
                        # code...
                        $lembaga = new Lembaga;
                        $lembaga->kode = $hasil;
                        $lembaga->cabang_id = $this->cabang_id;
                        $lembaga->name = $row[1];
                        $lembaga->kepalalembaga = $row[2];
                        $lembaga->jenjang = $row[3];
                        $lembaga->telp = $row[4];

                        if ($row[5] !== null) {
                            # code...
                            $kab     = strtoupper($row[5]);
                            $kab_kab = 'KAB. '.$kab;
                            $kab_kot = 'KOTA '.$kab;
                            $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                            $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                            //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                            if ($tes_kab !== null) {
                                # code...
                                $kabupaten_id = $tes_kab->id;
                                $lembaga->kabupaten_id = $kabupaten_id;
                                $lembaga->provinsi_id = $tes_kab->provinsi->id;
                            } 
                            if ($tes_kot !== null) {
                                # code...
                                $kabupaten_id = $tes_kot->id;
                                $lembaga->kabupaten_id = $kabupaten_id;
                                $lembaga->provinsi_id = $tes_kot->provinsi->id;
                            }
                        }

                        $lembaga->jml_guru = $row[6];
                        $lembaga->jml_santri = $row[7];
                        $lembaga->alamat = $row[8];
                        $lembaga->pengelola = $row[9];
                        $lembaga->status = $row[10];
                        $lembaga->created_at = new \DateTime;
                        $lembaga->save();
                    }else {
                        # code...
                        $kabupaten_id = null;
                        if ($row[5] !== null) {
                            # code...
                            $kab     = strtoupper($row[5]);
                            $kab_kab = 'KAB. '.$kab;
                            $kab_kot = 'KOTA '.$kab;
                            $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                            $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                            //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                            if ($tes_kab !== null) {
                                # code...
                                $kabupaten_id = $tes_kab->id;
                                // $lembaga->kabupaten_id = $kabupaten_id;
                                // $lembaga->provinsi_id = $tes_kab->provinsi->id;
                            } 
                            if ($tes_kot !== null) {
                                # code...
                                $kabupaten_id = $tes_kot->id;
                                // $lembaga->kabupaten_id = $kabupaten_id;
                                // $lembaga->provinsi_id = $tes_kot->provinsi->id;
                            }
                        }

                        $cabang = Cabang::where('id',$this->cabang_id)->first();
                        $lembaga = Lembaga::updateOrCreate(
                            [
                                'id'=> $data->id,
                            ],
                            [
                                'name' => $row[1],
                                'kepalalembaga' => $row[2],
                                'jenjang' => $row[3],
                                'telp' => $row[4],
                                'kabupaten_id'=> $kabupaten_id,
                                'jml_guru' => $row[6],
                                'jml_santri' => $row[7],
                                'alamat' => $row[8],
                                'pengelola' => $row[9],
                                'status' => $row[10],
                            ]
                        );
    
                    }
                }
                
            }


        }
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
