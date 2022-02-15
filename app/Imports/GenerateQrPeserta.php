<?php

namespace App\Imports;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GenerateQrPeserta implements ToCollection,ShouldQueue
{

    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id=$pelatihan_id;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $data = Peserta::where('pelatihan_id', $this->pelatihan_id)->where('bersyahadah',1)->get();
            foreach ($data as $key => $value) {
                # code...
                $value->update(['qr'=>'1']);
                \QrCode::size(150)
                ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
            }
    }
}
