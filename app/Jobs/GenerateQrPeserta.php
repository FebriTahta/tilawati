<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Queue\SerializesModels;

class GenerateQrPeserta implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $pelatihan_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pelatihan_id)
    {
        $this->$pelatihan_id = $pelatihan_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Peserta::where('pelatihan_id', 5190)->delete();
            // foreach ($data as $key => $value) {
            //     # code...
            //     $value->update(['qr'=>'1']);
            //     // \QrCode::size(150)
            //     // ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$value->slug, public_path('images/'.$value->slug.'.png'));
            // }
    }
}
