<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelatihan_id',
        'acara_id',
        'image',
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}
