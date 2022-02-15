<?php

namespace App\Imports;

use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Kabupaten;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Pelatihan;
use App\Models\Nilai;
use Illuminate\Support\Str;
use App\Models\Lembaga;
use Carbon\Carbon;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PesertaDiklatImport2 implements ToCollection, WithStartRow
{
    public function __construct($id,$tanggal,$cabang_id)
    {
        $this->id=$id;
        $this->tanggal=$tanggal;
        $this->cabang_id=$cabang_id;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        Validator::make($collection->toArray(), [
            'name' => 'string',
            'tgllahir' => 'date_format:Y-m-d',
            'bersyahadah' => 'numeric',
        ])->validate();

        
        foreach ($collection as $key => $row) {
            $diklat = Pelatihan::where('id',$this->id)->first();
            $peserta= Peserta::where('name',$row[0])->where('pelatihan_id', $this->id)->first();
            $dt_pel = new Peserta;
                        $dt_pel->phonegara_id = 175;
                        $dt_pel->pelatihan_id = $this->id;
                        $dt_pel->program_id = $diklat->program_id;
                        $dt_pel->cabang_id = $this->cabang_id;
                        $dt_pel->tanggal = $this->tanggal;
                        $dt_pel->name = $row[0];
                        $dt_pel->alamat = $row[1];
                        $dt_pel->kota = $row[2];
                        $dt_pel->status =1;
                        if (date('d-m-Y', strtotime($row[5]) !== false)) {
                            # code...
                            // $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(strtotime($row[5]));
                            $masuk = Carbon::createFromFormat('d/m/Y', $row[5])->format('Y-m-d');
                            $dt_pel->tgllahir = $masuk;
                        }else {
                            # code...
                            $dt_pel->tgllahir = '-';
                        }
                        $dt_pel->save();
        }
    }
}
