<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Http\Request;

class CekController extends Controller
{
    public function cek_qr(Request $request, $pelatihan_id)
    {
        if(request()->ajax())
        {
            $data = Peserta::where('pelatihan_id', $pelatihan_id)->where('bersyahadah',1)->where('qr',1)->count();
            return response()->json($data,200);
        }
    }

    public function generate_qr_peserta(Request $request, $pelatihan_id)
    {
        if(request()->ajax())
        {
            $data = Peserta::where('pelatihan_id', $pelatihan_id)->where('bersyahadah',1)->get();
            foreach ($data as $key => $value) {
                # code...
                $value->update(['qr'=>'1']);
                \QrCode::size(150)
                ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
            }
            $datas = $data->count();
            return response()->json($datas,200);
        }
    }
}
