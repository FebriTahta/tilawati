<?php

namespace App\Jobs;
use App\Models\Peserta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QRJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $pelatihan_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pelatihan_id)
    {
        $this->pelatihan_id = $pelatihan_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $insert_data=[];
        // $data = Peserta::where('pelatihan_id', $this->$pel)->where('bersyahadah',1)->get();
            // foreach ($data as $key => $value) {
            //     # code...
            //     $value->update(['qr'=>'1']);
            //     \QrCode::size(150)
            //     ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
            // }
            $data = Peserta::where('pelatihan_id', $this->pelatihan_id)
            ->where('bersyahadah',1)
            ->chunk(1, function($pesertass) {
                foreach ($pesertass as $value) {
                    // apply some action to the chunked results here
                    $value->update(['qr'=>'1']);
                    \QrCode::size(150)
                    ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
                }
            });
        

        // new Peserta::where('pelatihan_id', 5190)->delete();
        // for ($i=0; $i < 50 ; $i++) { 
        //     # code...
            
        // }       
        // Peserta::where('pelatihan_id', 5190)->delete();
    }

    
}
