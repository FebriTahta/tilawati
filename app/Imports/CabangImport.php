<?php

namespace App\Imports;
use App\Models\Cabang;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Hash;

class CabangImport implements ToCollection, WithChunkReading, ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 2) {
                
                $username_user      = $row[1];
                $kepala_cabang      = $row[2];
                $cek_username       = User::where('username', $username_user)->first();
                if ($cek_username !== null) {
                    # code...
                    //tidak kosong pilih id user

                } else {
                    # code...
                    //kosong buat user bar
                    $dt_usr     = new User;
                    $dt_usr->username = $username_user;
                    $dt_usr->password = Hash::make($row[2]);
                    $dt_usr->role     = $row[2];
                    $dt_usr->email    = $row[8];
                    $dt_usr->created_at = new \DateTime;
                    $dt_usr->save();

                    $dt_cab     = new Cabang;
                    $dt_cab->user_id    = $dt_usr->id;
                    $dt_cab->name       = $row[1];
                    $dt_cab->status     = 'Cabang';
                    $dt_cab->alamat     = $row[3];
                    //inisialisasi kota / kabupaten yang diinput
                    $kab     = strtoupper($row[4]);
                    $kab_kab = 'KAB. '.$kab;
                    $kab_kot = 'KOTA '.$kab;
                    $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                    $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                    //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                    if ($tes_kab !== null) {
                        # code...
                        $kabupaten_id = $tes_kab->id;
                        $dt_cab->kabupaten_id = $kabupaten_id;
                        $dt_cab->provinsi_id = $tes_kab->provinsi->id;
                    }
                    if ($tes_kot !== null) {
                        # code...
                        $kabupaten_id = $tes_kot->id;
                        $dt_cab->kabupaten_id = $kabupaten_id;
                        $dt_cab->provinsi_id = $tes_kot->provinsi->id;
                    }
                    //lanut protses insert data
                    $dt_cab->telp       = $row[7];
                    $dt_cab->created_at = new \DateTime;
                    $dt_cab->save();
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
