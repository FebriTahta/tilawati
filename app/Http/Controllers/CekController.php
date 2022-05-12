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
        // return $request->id;
        $data = Peserta::where('id',$request->id)->update(['slug' => "Updated Slug"]);
        // $value::updateOrCreate(
        //     [
        //         'id'=> $request->id
        //     ],
        //     [
        //         'slug'=> $value->name
        //     ]
        // );
        // \QrCode::size(150)
        //         ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$data->slug, public_path('images/'.$data->slug.'.png'));
        return $data->slug;
        return redirect()->back();
    }

    public function generate_qr_peserta(Request $request)
    {
        if(request()->ajax())
        {
            // $data = Peserta::where('pelatihan_id', $pelatihan_id)->where('bersyahadah',1)->get();
            // foreach ($data as $key => $value) {
            //     # code...
            //     $value->update(['qr'=>'1']);
            //     \QrCode::size(150)
            //     ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
            // }
            // $datas = $data->count();
            // return response()->json($datas,200);
            // $data = new GenerateQrPeserta($pelatihan_id);
            // new GenerateQrPeserta($pelatihan_id);

            // $jobs = new GenerateQrPeserta($pelatihan_id);
            // GenerateQrPeserta::dispatch($pelatihan_id)->beforeCommit();
            // $this->dispatch($jobs);
            // dispatch(new QRJob($pelatihan_id));
            // $pelatihan_id = $request->pel_id;
            // $tes = new QRJob($pelatihan_id);
            // $this->dispatch($tes);
            // return response()->json('queue-start',200);
            
        }
        // $pel = Pelatihan::where('id',$request->pel_id)->first();
            $pelatihan_id = $request->pelatihan_id2;
            // $this->dispatch(new QRJob($pelatihan_id));
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

            
            return response()->json($pelatihan_id,200);
    }
}
