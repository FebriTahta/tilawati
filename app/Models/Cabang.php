<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        // 'kepala',
        'propinsi_id',
        'kota_id',
        // 'alamat',
        // 'pos',
        // 'telp',
        // 'email',
        // 'ekspedisi',
        // 'jabatan'
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class);
    }
}
