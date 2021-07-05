<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }

    public function kepala()
    {
        return $this->hasMany(Kepala::class);
    }
    
}
