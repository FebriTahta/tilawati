<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;
    protected $fillable =[
        'cabang_id',
        'jenis_id',
        'propinsi_id',
        'kota_id',
        'keanggotaan'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

}
