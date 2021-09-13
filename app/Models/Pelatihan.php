<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'cabang_id',
        'program_id',
        'tanggal',
        // 'sampai_tanggal',
        'slug',
        'groupwa',
        'tempat',
        'keterangan',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function certificate()
    {
        return $this->hasMany(Certificate::class);
    }

    public function flyer()
    {
        return $this->hasMany(Flyer::class);
    }
}
