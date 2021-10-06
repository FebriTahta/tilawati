<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'kelurahan';

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kepala()
    {
        return $this->hasMany(Kepala::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
