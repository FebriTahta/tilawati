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
    public $value;
    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);
        $this->value->update(['qr'=>'1']);
            \QrCode::size(150)
        ->format('png') ->generate('https://www.profile.tilawatipusat.com/'.$this->value->slug, public_path('images/'.$this->value->slug.'.png'));
    }

    public function retryUntil()
    {
        return now()->addSeconds(8);
    }

    
}
