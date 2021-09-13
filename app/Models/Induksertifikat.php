<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Induksertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'program_name',
        'tgl_awal',
        'tgl_akhir',
        'cabang_id',
        'tempat',
        'slug'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function certificate()
    {
        return $this->hasMany(Certificate::class);
    }
}
