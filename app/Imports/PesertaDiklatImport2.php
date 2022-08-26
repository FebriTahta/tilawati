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
            'tgllahir' => 'date_format:m/d/Y|date',
            'bersyahadah' => 'numeric',
        ])->validate();

        $diklat = Pelatihan::where('id',$this->id)->first();
        if ($diklat->program->name == 'Diklat Munaqisy Cabang' || $diklat->program->name == "Training Of Trainer Guru Al-Qur'an") {
            # code...
            foreach ($collection as $key => $row) {
                # code...
                        if (is_numeric($row[5]) !== false) {
                            # code...
                            $tgllahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                        }else {
                            # code...
                            $tgllahir="";
                        }
    
                        $peserta= Peserta::where('name',$row[0])->where('pelatihan_id', $this->id)->first();
                        //TANPA ASAL CABANG
                        if ($peserta == null) {
                            
                            # code...
    
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
                            //slug
                            $slug = Str::slug($row[0].'-'.$diklat->program->name.'-'.Carbon::parse($this->tanggal)->isoFormat('MMMM-D-Y').'-'.$diklat->cabang->name.'-'.$diklat->cabang->kabupaten->nama);
                            $dt_pel->slug = $slug;
                            //inisialisasi kota / kabupaten yang diinput
    
                            $kab     = strtoupper($row[2]);
                            $kab_kab = 'KAB. '.$kab;
                            $kab_kot = 'KOTA '.$kab;
                            $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                            $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                            //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                            if ($tes_kab !== null) {
                                # code...
                                $kabupaten_id = $tes_kab->id;
                                $dt_pel->kabupaten_id = $kabupaten_id;
                                $dt_pel->provinsi_id = $tes_kab->provinsi->id;
                            } 
                            if ($tes_kot !== null) {
                                # code...
                                $kabupaten_id = $tes_kot->id;
                                $dt_pel->kabupaten_id = $kabupaten_id;
                                $dt_pel->provinsi_id = $tes_kot->provinsi->id;
                            }
    
                            $phone = $row[3];
    
                            if (substr($phone,0,1) == '0') {
                                # jika awalan angkanya 0 dari export maka langsung simpan
                                # code...
                                $telephone = $phone;
                                $dt_pel->telp = $telephone;
                                
                            }else{
                                # baca jika awalan tidak 0 melainkan 62 
                                if (substr($phone,0,2) == '62'){
                                    # code...
                                    $telephone = $phone;
                                    $dt_pel->telp = $telephone;
                                }else{
                                    // $potong = substr($phone,1,15);
                                    $telephone = '0'.$phone;
                                    $dt_pel->telp = $telephone;   
                                }
                            }
                            $dt_pel->tmptlahir = $row[4];
    
                            if (is_numeric($row[5]) !== false) {
                                # code...
                                $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                                $dt_pel->tgllahir=$masuk;
                            }
                            
                            // $lembaga = Lembaga::where('name',$row[6])->first();
                            // if ($lembaga !== null) {
                            //     # code...
                            //     $dt_pel->lembaga_id=$lembaga->id;
                            //     $dt_pel->lembaga=$row[6];
                            // }
    
                            // $dt_pel->jilid =$row[7];
                            $dt_pel->kriteria=$row[6];
    
                            $kriteria = Kriteria::where('name',$row[6])->first();
                            if ($kriteria !== null) {
                                # code...
                                $dt_pel->kriteria_id = $kriteria->id;
                            }
                            $dt_pel->bersyahadah = $row[7];
    
                            $dt_pel->created_at = new \DateTime;
    
    
                            $dt_pel->save();
    
                            foreach ( $dt_pel->pelatihan->program->penilaian as $key => $value) {
                                # code...
                                if ($row[$key+8] !== null) {
                                    # code...
                                    $dt_n = new Nilai;
                                    $dt_n->peserta_id = $dt_pel->id;
                                    $dt_n->penilaian_id=$value->id;
                                    $dt_n->nominal=$row[$key+8];
                                    $dt_n->kategori=$value->kategori;
                                    $dt_n->save();
                                }else {
                                    # code...
                                    $dt_n = new Nilai;
                                    $dt_n->peserta_id = $dt_pel->id;
                                    $dt_n->penilaian_id=$value->id;
                                    $dt_n->nominal='0';
                                    $dt_n->kategori=$value->kategori;
                                    $dt_n->save();
                                }
                                    
                            }
                            
                            $id = $dt_pel->id;
                            
                            // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$dt_pel->id.'/'.$dt_pel->pelatihan->program->id.'/'.$dt_pel->pelatihan->id, public_path('images/'.$id.'qrcode.png'));
                        }else{
                            
                            // UPDATE DENGAN ASAL CABANG
                            if (is_numeric($row[5]) !== false) {
                                # code...
                                $masuk1 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                                $dt_pel = Peserta::updateOrCreate(
                                [
                                    'id' => $peserta->id
                                ],
                                [
                                    'asal_cabang' => $row[0],
                                    'name'        => $row[1],
                                    'alamat'      => $row[2],
                                    'telp'        => $row[4],
                                    'tgllahir'    => $masuk1,
                                    'bersyahadah' => $row[8],
    
                                ]
                                );
                            }else {
                                # code...
                                $dt_pel = Peserta::updateOrCreate(
                                    [
                                        'id' => $peserta->id
                                    ],
                                    [
                                        'asal_cabang' => $row[0],
                                        'name'        => $row[1],
                                        'alamat'      => $row[2],
                                        'telp'        => $row[4],
                                        'bersyahadah' => $row[8],
        
                                    ]
                                    );
                            }
                            
                            
                            foreach ( $peserta->pelatihan->program->penilaian as $key => $value) {
                                # code...
                                if ($row[$key+10] !== null) {
                                    # code...
                                    Nilai::updateOrCreate(
                                        [
                                            'peserta_id'    => $peserta->id,
                                            'penilaian_id'  => $value->id,
                                        ],
                                        [
                                            'nominal'       => $row[$key+9],
                                            'kategori'      => $value->kategori,
                                        ]
                                    );
                                } else {
                                    # code...
                                    Nilai::updateOrCreate(
                                        [
                                            'peserta_id'    => $peserta->id,
                                            'penilaian_id'  => $value->id,
                                        ],
                                        [
                                            'nominal'       => 0,
                                            'kategori'      => $value->kategori,
                                        ]
                                    );
                                }
                                
                                
                            }
                            
                        }
                
            }
        }else {
            # code...
            foreach ($collection as $key => $row) {
                # code...
                        if (is_numeric($row[5]) !== false) {
                            # code...
                            $tgllahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                        }else {
                            # code...
                            $tgllahir="";
                        }
    
                        $peserta= Peserta::where('name',$row[0])->where('pelatihan_id', $this->id)->first();
                        if ($peserta == null) {
                            
                            # code...
    
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
                            //slug
                            $slug = Str::slug($row[0].'-'.$diklat->program->name.'-'.Carbon::parse($this->tanggal)->isoFormat('MMMM-D-Y').'-'.$diklat->cabang->name.'-'.$diklat->cabang->kabupaten->nama);
                            $dt_pel->slug = $slug;
                            //inisialisasi kota / kabupaten yang diinput
    
                            $kab     = strtoupper($row[2]);
                            $kab_kab = 'KAB. '.$kab;
                            $kab_kot = 'KOTA '.$kab;
                            $tes_kab = Kabupaten::select('*')->whereIn('nama',[$kab_kab])->first();
                            $tes_kot = Kabupaten::select('*')->whereIn('nama',[$kab_kot])->first();
                            //proses logika untuk mendapatkan kabupaten id & menginput provinsi id otomatis dari kabupaten
                            if ($tes_kab !== null) {
                                # code...
                                $kabupaten_id = $tes_kab->id;
                                $dt_pel->kabupaten_id = $kabupaten_id;
                                $dt_pel->provinsi_id = $tes_kab->provinsi->id;
                            } 
                            if ($tes_kot !== null) {
                                # code...
                                $kabupaten_id = $tes_kot->id;
                                $dt_pel->kabupaten_id = $kabupaten_id;
                                $dt_pel->provinsi_id = $tes_kot->provinsi->id;
                            }
    
                            $phone = $row[3];
    
                            if (substr($phone,0,1) == '0') {
                                # jika awalan angkanya 0 dari export maka langsung simpan
                                # code...
                                $telephone = $phone;
                                $dt_pel->telp = $telephone;
                                
                            }else{
                                # baca jika awalan tidak 0 melainkan 62 
                                if (substr($phone,0,2) == '62'){
                                    # code...
                                    $telephone = $phone;
                                    $dt_pel->telp = $telephone;
                                }else{
                                    // $potong = substr($phone,1,15);
                                    $telephone = '0'.$phone;
                                    $dt_pel->telp = $telephone;   
                                }
                            }
                            $dt_pel->tmptlahir = $row[4];
    
                            if (is_numeric($row[5]) !== false) {
                                # code...
                                $masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                                $dt_pel->tgllahir=$masuk;
                            }
                            
                            $lembaga = Lembaga::where('name',$row[6])->first();
                            if ($lembaga !== null) {
                                # code...
                                $dt_pel->lembaga_id=$lembaga->id;
                                $dt_pel->lembaga=$row[6];
                            }
    
                            $dt_pel->jilid =$row[7];
                            $dt_pel->kriteria=$row[8];
    
                            $kriteria = Kriteria::where('name',$row[8])->first();
                            if ($kriteria !== null) {
                                # code...
                                $dt_pel->kriteria_id = $kriteria->id;
                            }
                            $dt_pel->bersyahadah = $row[9];
    
                            $dt_pel->created_at = new \DateTime;
    
    
                            $dt_pel->save();
    
                            foreach ( $dt_pel->pelatihan->program->penilaian as $key => $value) {
                                # code...
                                if ($row[$key+10] !== null) {
                                    # code...
                                    $dt_n = new Nilai;
                                    $dt_n->peserta_id = $dt_pel->id;
                                    $dt_n->penilaian_id=$value->id;
                                    $dt_n->nominal=$row[$key+10];
                                    $dt_n->kategori=$value->kategori;
                                    $dt_n->save();
                                }else {
                                    # code...
                                    $dt_n = new Nilai;
                                    $dt_n->peserta_id = $dt_pel->id;
                                    $dt_n->penilaian_id=$value->id;
                                    $dt_n->nominal='0';
                                    $dt_n->kategori=$value->kategori;
                                    $dt_n->save();
                                }
                                    
                            }
                            
                            $id = $dt_pel->id;
                            
                            // ->generate('https://www.tilawatipusat.com/diklat-profile-peserta/'.$dt_pel->id.'/'.$dt_pel->pelatihan->program->id.'/'.$dt_pel->pelatihan->id, public_path('images/'.$id.'qrcode.png'));
                        }else{
    
                            if (is_numeric($row[5]) !== false) {
                                # code...
                                $masuk1 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                                $dt_pel = Peserta::updateOrCreate(
                                [
                                    'id' => $peserta->id
                                ],
                                [
                                    'name'        => $row[0],
                                    'alamat'      => $row[1],
                                    'telp'        => $row[3],
                                    'tgllahir'    => $masuk1,
                                    'jilid'       => $row[7],
                                    'kriteria'    => $row[8],
                                    'bersyahadah' => $row[9],
    
                                ]
                                );
                            }else {
                                # code...
                                $dt_pel = Peserta::updateOrCreate(
                                    [
                                        'id' => $peserta->id
                                    ],
                                    [
                                        'name'        => $row[0],
                                        'alamat'      => $row[1],
                                        'telp'        => $row[3],
                                        'jilid'       => $row[7],
                                        'kriteria'    => $row[8],
                                        'bersyahadah' => $row[9],
        
                                    ]
                                    );
                            }
                            
                            
                            foreach ( $peserta->pelatihan->program->penilaian as $key => $value) {
                                # code...
                                if ($row[$key+10] !== null) {
                                    # code...
                                    Nilai::updateOrCreate(
                                        [
                                            'peserta_id'    => $peserta->id,
                                            'penilaian_id'  => $value->id,
                                        ],
                                        [
                                            'nominal'       => $row[$key+10],
                                            'kategori'      => $value->kategori,
                                        ]
                                    );
                                } else {
                                    # code...
                                    Nilai::updateOrCreate(
                                        [
                                            'peserta_id'    => $peserta->id,
                                            'penilaian_id'  => $value->id,
                                        ],
                                        [
                                            'nominal'       => 0,
                                            'kategori'      => $value->kategori,
                                        ]
                                    );
                                }
                                
                                
                            }
                            
                        }
                
            }
        }
        
    }
}
