<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use App\Models\Pelatihan;
use Jobs;
use App\Jobs\GenerateQrPeserta;
use App\Jobs\QRJob;

use SimpleSoftwareIO\QrCode\Generator;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

    public function force_qr(Request $request)
    {
        $diklat = Pelatihan::where('id', $request->pelatihan_id)->first();
        $data   = Peserta::where('id',$request->id)->first();
        $slug   = Str::slug($data->name.'-'.$diklat->program->name.'-'.Carbon::parse($diklat->tanggal)->isoFormat('MMMM-D-Y').'-'.$diklat->cabang->name.'-'.$diklat->cabang->kabupaten->nama);
        $x = Peserta::where('id',$request->id)->update(['slug' => $slug]);
        \QrCode::size(150)
                ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$data->slug, public_path('images/'.$data->slug.'.png'));
        return redirect()->back();
    }

    public function generate_qr_peserta($pelatihan_id,Request $request)
    {
        
            set_time_limit(0);
            // $pelatihan_id = $request->pelatihan_id2;
            $data = Peserta::where('pelatihan_id', $pelatihan_id)
            ->where('bersyahadah',1)
            ->chunk(1, function($pesertass) {
                foreach ($pesertass as $value) {
                    // apply some action to the chunked results here
                    // $value->update(['qr'=>'1']);
                    // \QrCode::size(150)
                    // ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
                    QRJob::dispatch($value);
                }
            });
            // return redirect()->back();
            // return response()->json($pelatihan_id,200);
    }

    public function reset_stat_qr(Request $request)
    {
            set_time_limit(0);
            $pelatihan_id = $request->pelatihan_id2;
            $data = Peserta::where('pelatihan_id', $pelatihan_id)
            ->where('bersyahadah',1)
            ->update([
                'qr'=>'0'
            ]);

            return redirect()->back();
    }
}
