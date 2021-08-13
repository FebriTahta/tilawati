<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'subjudul',
        'slug',
        'tanggal',
        'jam',
        'tempat'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function flyer()
    {
        return $this->hasOne(Flyer::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
