<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $fillable = [
        'id',
        'provinsi_id',
        'nama',
        'id_jenis',
    ];
    
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
    
    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function kepala()
    {
        return $this->hasMany(Kepala::class);
    }
}
