<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'induksertifikat_id',
        'pelatihan_id',
        'program_id',
        'cabang_id',
        'tanggal',
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

    public function induksertifikat()
    {
        return $this->belongsTo(Induksertifikat::class);
    }
}
