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
                $data = Lembaga::where('cabang_id', $this->cabang_id)->where('name',$row[1])->where('kepalalembaga',$row[2])->where('telp',$row[4])->where('jml_guru',$row[6])->where('jml_santri', $row[7])->first();
                $cabang = Cabang::where('id',$this->cabang_id)->first();
                $kode = mt_rand(100000, 999999);
                $hasil = 'lmb-'.$kode.'-cb-'.$cabang->id.'-'.$cabang->lembaga->count();

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
                    // $lembaga->provinsi_id = $cabang->provinsi_id;
                    // $lembaga->kabupaten_id= $cabang->kabupaten_id;
                    $lembaga->created_at = new \DateTime;
                    $lembaga->save();
                }else {
                    # code...

                    
                }
            }
            // // $username_user      = $row[1];
            // // $kepala_lembaga      = $row[2];
            // // $cek_username       = User::where('username', $username_user)->first();
            // // $total_username     = User::where('username', $username_user)->get();
            // // $cek_kepala         = Kepala::where('name', $kepala_lembaga)->first();

            // // if ($row[1] !== null) {
            // //     # code...
            // //     if ($cek_username !== null) {
            // //         # code...
            // //         $username_baru      = $username_user.''.$key.'';
            // //         $dt_usr             = new User;
            // //         $dt_usr->username   = $username_baru;
            // //         $dt_usr->password   = Hash::make('lembaga_nf');
            // //         $dt_usr->role       = 'lembaga';
            // //         $dt_usr->created_at = new \DateTime;
            // //         $dt_usr->save();

            // //         $dt_lem = new Lembaga;
            // //         $dt_lem->name = $row[1];
            // //         $dt_lem->user_id = $dt_usr->id;

            // //         if ($row[10] !== null) {
            // //             # code...
            // //             $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]);
            // //             $dt_lem->tahunmasuk = $masuk;
            // //         }else{
            // //             $dt_lem->tahunmasuk = new \DateTime;
            // //         }

            // //         $kode = mt_rand(100000, 999999);
                    
            // //         $cek_kode_lembaga    = Lembaga::where('kode', $kode)->first();
            // //         if ($cek_kode_lembaga == null) {
            // //             # code...
            // //             $dt_lem->kode       = $kode;
            // //         } else {
            // //             # code...
            // //             $kode  = mt_rand(100000, 999999);
            // //             $hasil = $kode + $key;
            // //             $dt_lem->kode       = $hasil;
            // //         }
                    
            // //         //inisialisasi kota / kabupaten yang diinput
            // //         $kab     = strtoupper($row[5]);
            // //         $dt_lem->alamat = $row[4];

            // //         $kab_kab = 'KAB. '.$kab;
            // //         $kab_kot = 'KOTA '.$kab;
            // //         $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
            // //         $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
            // //         //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
            // //         if ($tes_kab !== null) {
            // //             # code...
            // //             $kabupaten_id = $tes_kab->id;
            // //             $dt_lem->kabupaten_id = $kabupaten_id;
            // //             $dt_lem->provinsi_id = $tes_kab->provinsi->id;
            // //             $dt_lem->daerah = $kab;
            // //         } 
            // //         if ($tes_kot !== null) {
            // //             # code...
            // //             $kabupaten_id = $tes_kot->id;
            // //             $dt_lem->kabupaten_id = $kabupaten_id;
            // //             $dt_lem->provinsi_id = $tes_kot->provinsi->id;
            // //             $dt_lem->daerah = $kab;
            // //         }

            // //         $dt_lem->jml_guru = $row[7];
            // //         $dt_lem->jml_santri = $row[8];
            // //         if ($row[9]!==null) {
            // //             # code...
            // //             if ($row[9]=='Ya') {
            // //                 # code...
            // //                 $dt_lem->status = 'Aktif';
            // //             } else {
            // //                 # code...
            // //                 $dt_lem->status = 'Non Aktif';
            // //             }
            // //         }else{
            // //             $dt_lem->status = 'Non Aktif';
            // //         }
                    
                    
            // //         //kepala
            // //         if ($row[2] !== null) {
            // //             # code...
            // //             //inisialisasi kepala cabang ada atau tidak
            // //             if ($cek_kepala !== null) {
            // //                 # code...
            // //                 // $dt_cab->kepala()->attach($cek_kepala);
            // //                 $kepala_id = $cek_kepala->id;
            // //                 $dt_lem->kepala_id = $kepala_id;
            // //                 $dt_lem->save();
    
            // //             }else{
            // //                 $dt_kep = new Kepala;
            // //                 $dt_kep->name   = $kepala_lembaga;
            // //                 $dt_kep->save();
            // //                 // $dt_cab->kepala()->attach($dt_kep);
            // //                 $kepala_id = $dt_kep->id;
            // //                 $dt_lem->kepala_id = $kepala_id;
            // //                 $dt_lem->save();
            // //             }
            // //         } else {
            // //             # code...
            // //             $dt_lem->save();
            // //         }
                    

            // //     }else{
            // //         $username_baru      = $username_user;
            // //         $dt_usr             = new User;
            // //         $dt_usr->username   = $username_baru;
            // //         $dt_usr->password   = Hash::make('lembaga_nf');
            // //         $dt_usr->role       = 'lembaga';
            // //         $dt_usr->created_at = new \DateTime;
            // //         $dt_usr->save();
    
            // //         $dt_lem = new Lembaga;
            // //         $dt_lem->name = $row[1];
            // //         $dt_lem->user_id = $dt_usr->id;
                    
            // //         if ($row[10] !== null) {
            // //             # code...
            // //             $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]);
            // //             $dt_lem->tahunmasuk = $masuk;
            // //         }else{
            // //             $dt_lem->tahunmasuk = new \DateTime;
            // //         }

            // //         $kode = mt_rand(100000, 999999);
                    
            // //         $cek_kode_lembaga    = Lembaga::where('kode', $kode)->first();
            // //         if ($cek_kode_lembaga == null) {
            // //             # code...
            // //             $dt_lem->kode       = $kode;
            // //         } else {
            // //             # code...
            // //             $kode  = mt_rand(100000, 999999);
            // //             $hasil = $kode + $key;
            // //             $dt_lem->kode       = $hasil;
            // //         }

            // //         //inisialisasi kota / kabupaten yang diinput
            // //         $kab     = strtoupper($row[5]);
            // //         $dt_lem->alamat = $row[4];

            // //         $kab_kab = 'KAB. '.$kab;
            // //         $kab_kot = 'KOTA '.$kab;
            // //         $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
            // //         $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
            // //         //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
            // //         if ($tes_kab !== null) {
            // //             # code...
            // //             $kabupaten_id = $tes_kab->id;
            // //             $dt_lem->kabupaten_id = $kabupaten_id;
            // //             $dt_lem->provinsi_id = $tes_kab->provinsi->id;
            // //             $dt_lem->daerah = $kab;
            // //         } 
            // //         if ($tes_kot !== null) {
            // //             # code...
            // //             $kabupaten_id = $tes_kot->id;
            // //             $dt_lem->kabupaten_id = $kabupaten_id;
            // //             $dt_lem->provinsi_id = $tes_kot->provinsi->id;
            // //             $dt_lem->daerah = $kab;
            // //         }
                    
            // //         $dt_lem->jml_guru = $row[7];
            // //         $dt_lem->jml_santri = $row[8];
            // //         if ($row[9]!==null) {
            // //             # code...
            // //             if ($row[9]=='Ya') {
            // //                 # code...
            // //                 $dt_lem->status = 'Aktif';
            // //             } else {
            // //                 # code...
            // //                 $dt_lem->status = 'Non Aktif';
            // //             }
            // //         }else{
            // //             $dt_lem->status = 'Non Aktif';
            // //         }
                    

            // //         //kepala
            // //         if ($row[2] !== null) {
            // //             # code...
            // //             //inisialisasi kepala cabang ada atau tidak
            // //             if ($cek_kepala !== null) {
            // //                 # code...
            // //                 // $dt_cab->kepala()->attach($cek_kepala);
            // //                 $kepala_id = $cek_kepala->id;
            // //                 $dt_lem->kepala_id = $kepala_id;
            // //                 $dt_lem->save();
    
            // //             }else{
            // //                 $dt_kep = new Kepala;
            // //                 $dt_kep->name   = $kepala_lembaga;
            // //                 $dt_kep->save();
            // //                 // $dt_cab->kepala()->attach($dt_kep);
            // //                 $kepala_id = $dt_kep->id;
            // //                 $dt_lem->kepala_id = $kepala_id;
            // //                 $dt_lem->save();
            // //             }
            // //         } else {
            // //             # code...
            // //             $dt_lem->save();
            // //         }

            // //     }
                
            // // }else{

            // //     $username_baru      = 'kosong'.$key.'';
            // //     $dt_usr             = new User;
            // //     $dt_usr->username   = $username_baru;
            // //     $dt_usr->password   = Hash::make('lembaga_nf');
            // //     $dt_usr->role       = 'lembaga';
            // //     $dt_usr->created_at = new \DateTime;
            // //     $dt_usr->save();
                
            // //     $dt_lem = new Lembaga;
            // //     $dt_lem->name = 'Kosong';
            // //     $dt_lem->user_id = $dt_usr->id;

            // //     if ($row[10] !== null) {
            // //         # code...
            // //         $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]);
            // //         $dt_lem->tahunmasuk = $masuk;
            // //     }else{
            // //         $dt_lem->tahunmasuk = new \DateTime;
            // //     }

            // //     $kode = mt_rand(100000, 999999);
                    
            // //         $cek_kode_lembaga    = Lembaga::where('kode', $kode)->first();
            // //         if ($cek_kode_lembaga == null) {
            // //             # code...
            // //             $dt_lem->kode       = $kode;
            // //         } else {
            // //             # code...
            // //             $kode  = mt_rand(100000, 999999);
            // //             $hasil = $kode + $key;
            // //             $dt_lem->kode       = $hasil;
            // //         }

            // //     //inisialisasi kota / kabupaten yang diinput
            // //     $kab     = strtoupper($row[5]);
            // //     $dt_lem->alamat = $row[4];

            // //     $kab_kab = 'KAB. '.$kab;
            // //     $kab_kot = 'KOTA '.$kab;
            // //     $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
            // //     $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
            // //     //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
            // //     if ($tes_kab !== null) {
            // //         # code...
            // //         $kabupaten_id = $tes_kab->id;
            // //         $dt_lem->kabupaten_id = $kabupaten_id;
            // //         $dt_lem->provinsi_id = $tes_kab->provinsi->id;
            // //         $dt_lem->daerah = $kab;
            // //     } 
            // //     if ($tes_kot !== null) {
            // //         # code...
            // //         $kabupaten_id = $tes_kot->id;
            // //         $dt_lem->kabupaten_id = $kabupaten_id;
            // //         $dt_lem->provinsi_id = $tes_kot->provinsi->id;
            // //         $dt_lem->daerah = $kab;
            // //     }
                
            // //     $dt_lem->jml_guru = $row[7];
            // //     $dt_lem->jml_santri = $row[8];
            // //         if ($row[9]!==null) {
            // //             # code...
            // //             if ($row[9]=='Ya') {
            // //                 # code...
            // //                 $dt_lem->status = 'Aktif';
            // //             } else {
            // //                 # code...
            // //                 $dt_lem->status = 'Non Aktif';
            // //             }
            // //         }else{
            // //             $dt_lem->status = 'Non Aktif';
            // //         }

            // //     //kepala
            // //     if ($row[2] !== null) {
            // //         # code...
            // //         //inisialisasi kepala cabang ada atau tidak
            // //         if ($cek_kepala !== null) {
            // //             # code...
            // //             // $dt_cab->kepala()->attach($cek_kepala);
            // //             $kepala_id = $cek_kepala->id;
            // //             $dt_lem->kepala_id = $kepala_id;
            // //             $dt_lem->save();

            // //         }else{
            // //             $dt_kep = new Kepala;
            // //             $dt_kep->name   = $kepala_lembaga;
            // //             $dt_kep->save();
            // //             // $dt_cab->kepala()->attach($dt_kep);
            // //             $kepala_id = $dt_kep->id;
            // //             $dt_lem->kepala_id = $kepala_id;
            // //             $dt_lem->save();
            // //         }
            // //     } else {
            // //         # code...
            // //         $dt_lem->save();
            // //     }
                
                
            // }


        }
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
