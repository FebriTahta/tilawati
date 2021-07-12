<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'cabang_id',
        'program_id',
        // 'name',
        'keterangan',
        'tempat'
    ];
    protected $dates = ['deleted_at'];

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
}
