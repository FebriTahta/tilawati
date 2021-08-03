<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelatihan_id',
        'peserta_id',
        'no',
        'name',
        'link',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
