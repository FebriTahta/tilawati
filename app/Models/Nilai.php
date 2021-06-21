<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'penilaian_id',
        'peserta_id',
        'nominal',
        'kategori'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
