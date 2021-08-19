<?php

namespace App\Imports;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\Kabupaten;
use App\Models\Pelatihan;
use App\Models\Nilai;
use App\Models\Lembaga;
use App\Models\Certificate;
use DB;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EsertifikatImport implements ToCollection
{
    public function __construct($id)
    {
        $this->id=$id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            # code...
            if ($key >= 1) {

                $data = Peserta::where('pelatihan_id',$this->id)->first();
                $data2= Pelatihan::find($this->id);
                $name = $row[1];

                if ($data == null) {
                    # code...
                    $dt_p = new Peserta;
                    $dt_p->pelatihan_id = $this->id;
                    $dt_p->name         = $name;
                    $dt_p->tanggal      = $data2->tanggal;
                    $dt_p->status       = 1;
                    $dt_p->created_at   = new \DateTime;
                    $dt_p->save();

                    $dt_n = new Certificate;
                    $dt_n->pelatihan_id = $this->id;
                    $dt_n->peserta_id   = $dt_p->id;
                    $dt_n->no           = $row[0];
                    $dt_n->name         = $name;
                    $dt_n->link         = $row[2];
                    $dt_n->created_at   = new \DateTime;
                    $dt_n->save();
                }else{
                    $peserta = Peserta::where('name',$name)->where('pelatihan_id',$this->id)->first();
                    if ($peserta !== null) {
                        # code...
                        $dt_n = new Certificate;
                        $dt_n->pelatihan_id = $this->id;
                        $dt_n->peserta_id   = $peserta->id;
                        $dt_n->no           = $row[0];
                        $dt_n->name         = $name;
                        $dt_n->link         = $row[2];
                        $dt_n->created_at   = new \DateTime;
                        $dt_n->save();
                    }else{
                        $peserta_lama_yang_tidak_ada_di_sertifikat_baru = Peserta::where('pelatihan_id',$this->id)->first();
                        if ($peserta_lama_yang_tidak_ada_di_sertifikat_baru->name !== $row[1] ) {
                            # code...
                            // $peserta->delete();
                            $dt_p = new Peserta;
                            $dt_p->pelatihan_id = $this->id;
                            $dt_p->name         = $name;
                            $dt_p->tanggal      = $data2->tanggal;
                            $dt_p->status       = 1;
                            $dt_p->created_at   = new \DateTime;
                            $dt_p->save();

                            $dt_n = new Certificate;
                            $dt_n->pelatihan_id = $this->id;
                            $dt_n->peserta_id   = $dt_p->id;
                            $dt_n->no           = $row[0];
                            $dt_n->name         = $name;
                            $dt_n->link         = $row[2];
                            $dt_n->created_at   = new \DateTime;
                            $dt_n->save();
                        }else{
                            $dt_n = new Certificate;
                            $dt_n->pelatihan_id = $this->id;
                            $dt_n->peserta_id   = $peserta_lama_yang_tidak_ada_di_sertifikat_baru->id;
                            $dt_n->no           = $row[0];
                            $dt_n->name         = $name;
                            $dt_n->link         = $row[2];
                            $dt_n->created_at   = new \DateTime;
                            $dt_n->save();

                        }
                    }
                }

            }   
        }
    }
}
