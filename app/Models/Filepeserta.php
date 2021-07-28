<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filepeserta extends Model
{
    use HasFactory;
    protected $fillable = [
        'peserta_id',
        'registrasi_id',
        'file',
        'status'
    ];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['file'] = json_encode($value);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class);
    }
}
